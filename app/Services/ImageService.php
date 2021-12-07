<?php

namespace App\Services;

use App\Contracts\Services\Image as ImageContract;
use Spatie\Image\Image;

class ImageService implements ImageContract
{
    public $path;

    protected $media;

    public function load(string $path)
    {
        $this->path = $path;
        $this->media = Image::load($this->path);
        return $this;
    }

    public function optimize(string $path = null)
    {
        if (is_null($path)) {
            $path = $this->path;
        }

        $this->media->optimize()->save($path);

        return $this;
    }

    public function makeNormalImage(string $path = null)
    {
        if (is_null($path)) {
            $path = $this->path;
        }

        $this->media->width(250)->height(250)->save($path);

        return $this;
    }

    public function makeSmallImage(string $path = null)
    {
        if (is_null($path)) {
            $path = $this->path;
        }

        $this->media->width(100)->height(100)->save($path);

        return $this;
    }
}
