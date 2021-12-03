<?php

namespace App\Facades\Bindings;

use Illuminate\Support\Facades\Facade;
use App\Contracts\Services\Bindings\MediaService as MediaContractService;

class MediaService extends Facade
{
    public static function getFacadeAccessor()
    {
        return MediaContractService::class;
    }
}
