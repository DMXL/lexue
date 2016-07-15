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

    private $menu;

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
     * @return \Illuminate\Support\Collection
     */
    public function menu()
    {
        return $this->menu;
    }

    /**
     * Generate page meta
     */
    public function generate()
    {
        if (! $this->routeName OR ! $this->routeNameSpace) {
            return null;
        }

        /* Generate bct */
        $this->generateBct();

        $this->generateMenu();

        /* Generate title */
        if ($this->bct) {
            $endNode = $this->bct->last();
            if (isset($endNode['end']) AND $endNode['end']) {
                $this->title = $endNode['title'];
            }
        }
    }

    private function generateBct()
    {
        // find bct structure config
        if (! $config = config('pages.bct.' . $this->routeNameSpace)) {
            return null;
        }

        /* generate bct */
        $this->bct = $this->buildBctNodes($config);
    }

    /**
     * @param $config
     * @return Collection|null
     */
    private function buildBctNodes($config)
    {
        foreach ($config as $node) {
            if ($this->fullRoute($node['route']) === $this->routeName) {
                return $this->buildBctNode($this->routeName, $node['title']);
            } elseif (isset($node['children'])) {
                $children = $node['children'];

                if ($newNodes = $this->buildBctNodes($children)) {
                    return $this->buildBctNode($this->fullRoute($node['route']), $node['title'], $newNodes);
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
    private function buildBctNode($route, $title, $newNodes = [])
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

    private function generateMenu()
    {
        // find bct structure config
        if (! $config = config('pages.menu.' . $this->routeNameSpace)) {
            return null;
        }

        $config = $this->prepareMenuDate($config);

        /* generate bct */
        $this->menu = $this->buildMenuNodes($config);
    }

    // TODO should be able to optimize the algorithm. this is nasty
    private function buildMenuNodes($menu)
    {
        foreach ($menu as $key => $node) {
            if (isset($node['children'])) {
                $menu[$key]['active'] = collect($node['children'])->flatten()->search($this->routeName, true);
                $menu[$key]['children'] = $this->buildMenuNodes($node['children']);
            } elseif (isset($node['route'])) {
                $menu[$key]['active'] = $node['route'] === $this->routeName;
            }
        }

        return $menu;
    }

    private function prepareMenuDate($config)
    {
        // prepare data
        foreach ($config as $key => $node) {
            if (isset($node['route'])) {
                $config[$key]['route'] = $this->fullRoute($node['route']);
            }
            $config[$key]['active'] = false;

            if (isset($node['children'])) {
                $config[$key]['children'] = $this->prepareMenuDate($node['children']);
            }
        }

        return $config;
    }

    private function fullRoute($route)
    {
        if ($this->routeNameSpace) {
            return $this->routeNameSpace . '::' . $route;
        }

        return $route;
    }
}