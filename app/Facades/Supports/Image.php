<?php

namespace App\Facades\Supports;

use Illuminate\Support\Facades\Facade;
use App\Contracts\Services\Image as ImageService;

class Image extends Facade
{
    public static function getFacadeAccessor()
    {
        return ImageService::class;
    }
}
