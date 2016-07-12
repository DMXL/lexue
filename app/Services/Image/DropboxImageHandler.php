<?php
/**
 * Created by PhpStorm.
 * User: veoc
 * Date: 3/07/16
 * Time: 9:14 PM
 */

namespace App\Services\Image;

use Dropbox\WriteMode;
use Illuminate\Http\Request;
use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use League\Glide\Responses\LaravelResponseFactory;
use League\Glide\ServerFactory as Glide;
use League\Flysystem\Dropbox\DropboxAdapter;
use Dropbox\Client;

class DropboxImageHandler
{
    /*
    |--------------------------------------------------------------------------
    | Dependencies
    |--------------------------------------------------------------------------
    */

    /**
     * @var \Dropbox\Client
     */
    private $dropboxClient;

    private $dropboxServer;
    private $dropboxFilesystem;
    private $dropboxCacheFilsystem;

    private $tmpServer;
    private $tmpFilesystem;
    private $tmpCacheFilsystem;
    private $tmpCachePath;

    function __construct()
    {
        /* Dropbox image server */
        $this->dropboxClient = new Client(config('dropbox.token'), config('dropbox.secret'));
        $this->dropboxFilesystem = new Filesystem(new DropboxAdapter($this->dropboxClient));
        $this->dropboxCacheFilsystem = new Filesystem(new Local(config('image.paths.cache')));
        
        $this->dropboxServer = Glide::create([
            'source' => $this->dropboxFilesystem,
            'cache' => $this->dropboxCacheFilsystem,
            'response' => new LaravelResponseFactory(),
            'presets' => config('image.presets'),
        ]);

        /* Local tmp image server */
        $this->tmpFilesystem = new Filesystem(new Local('/'));
        $this->tmpCachePath = config('image.paths.cache');
        $this->tmpCacheFilsystem = new Filesystem(new Local($this->tmpCachePath));

        $this->tmpServer = Glide::create([
            'source' => $this->tmpFilesystem,
            'cache' => $this->tmpCacheFilsystem
        ]);
    }

    public function uploadAvatar($file, $path) {
        $image = $this->tmpServer->makeImage($file, ['w' => 300, 'h' => 300, 'fit' => 'max']);
        $imagePath = $this->tmpCachePath . '/' . $image;
        $uploadMeta = $this->upload(fopen($imagePath, 'r'), $path);

        // manually clear the tmp cache folder
        // the cache file should be removed already
        $this->tmpCacheFilsystem->deleteDir(dirname($imagePath));

        return $uploadMeta;
    }

    private function upload($file, $path)
    {
        // this could also be written to use the dropboxFilesystem
        // but that only supports uploading by string
        return $this->dropboxClient->uploadFile($path, WriteMode::force(), $file);
    }

    public function get(Request $request, $type, $file)
    {
        if ($type === 'avatar') {
            $this->getAvatar($request, $file);
        } else {
            $this->getImage($request, $file);
        }
    }

    private function getAvatar($request, $file)
    {
        $file = 'avatar/' . $file;
        $this->retrieve($request, $file);
    }

    private function getImage($request, $file)
    {
        $file = 'image/' . $file;
        $this->retrieve($request, $file);
    }

    /**
     * @param Request $request
     * @param string $file
     */
    private function retrieve($request, $file)
    {
        $this->dropboxServer->outputImage($file, $request->all());
    }
}