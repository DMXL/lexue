<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 5/07/16
 * Time: 10:42 AM
 */

namespace App\Services\Image;

use Illuminate\Http\Request;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory as Glide;

class LocalImageHandler
{
    /*
    |--------------------------------------------------------------------------
    | Dependencies
    |--------------------------------------------------------------------------
    */

    private $imageServer;
    private $filesystem;
    private $cacheFilsystem;

    function __construct()
    {
        $this->filesystem = new Filesystem(new Local(config('image.paths.local')));
        $this->cacheFilsystem = new Filesystem(new Local(config('image.paths.cache')));

        $this->imageServer = Glide::create([
            'source' => $this->filesystem,
            'cache' => $this->cacheFilsystem,
            'response' => new LaravelResponseFactory(),
            'presets' => config('image.presets.avatar'),
        ]);
    }

    public function getDefault(Request $request, $file)
    {
        $file = 'default/' . ltrim($file, '/');
        $this->get($request, $file);
    }

    public function get(Request $request, $file)
    {
        $file = ltrim($file, "/");
        $this->imageServer->outputImage($file, $request->all());
    }
}