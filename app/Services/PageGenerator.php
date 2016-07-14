<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 13/07/16
 * Time: 4:49 PM
 */

namespace App\Services;


use Illuminate\Support\Collection;

class PageGenerator
{
    private $routeName;

    private $routeNameSpace;

    /**
     * @var \Illuminate\Support\Collection
     */
    private $bct;

    /**
     * @var string
     */
    private $title;

    /**
     * BctGenerator constructor.
     */
    public function __construct()
    {
        $this->routeName = \Route::currentRouteName() ? : null;

        if ($this->routeName AND preg_match('/^(.+)::/', $this->routeName, $matches)) {
            $this->routeNameSpace = $matches[1];
        } else {
            $this->routeNameSpace = null;
        }

        $this->generate();
    }

    /**
     * @return string
     */
    public function title()
    {
        return $this->title;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function bct()
    {
        return $this->bct;
    }

    /**
     * Generate page meta
     */
    public function generate()
    {
        if (! $this->routeName OR ! $this->routeNameSpace) {
            return null;
        }

        // find page structure config
        if (! $config = config('pages.' . $this->routeNameSpace)) {
            return null;
        }

        /* set bct */
        $this->bct = $this->buildNodes($config);

        /* set title */
        if ($this->bct) {
            $endNode = $this->bct->last();
            if (isset($endNode['end']) AND $endNode['end']) {
                $this->title = $endNode['title'];
            }
        }

    }

    /**
     * @param $config
     * @return Collection|null
     */
    private function buildNodes($config)
    {
        foreach ($config as $route => $node) {
            if ($this->routeNameSpace . '::' . $route === $this->routeName) {
                return $this->buildNode($this->routeName, $node['title']);
            } elseif (isset($node['children'])) {
                $children = $node['children'];

                if ($newNodes = $this->buildNodes($children)) {
                    return $this->buildNode($this->routeNameSpace . '::' . $route, $node['title'], $newNodes);
                }
            } else {
                return null;
            }
        }

        return null;
    }

    /**
     * @param $route
     * @param $title
     * @param array $newNodes
     * @return Collection
     */
    private function buildNode($route, $title, $newNodes = [])
    {
        $selfNode = [
            'route' => $route,
            'title' => $title
        ];

        // check if is end node
        if (!$newNodes) {
            $selfNode['end'] = true;
        }

        return collect($newNodes)->prepend($selfNode);
    }
}