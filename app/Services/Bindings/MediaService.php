<?php

namespace App\Services\Bindings;

use App\Contracts\Services\Bindings\MediaService as MediaContractService;
use App\Contracts\Http\Responses\Media\UserMediasResponse as UserMediasContractResponse;
use App\Http\Responses\Media\UserMediasResponse;
use App\Contracts\Repositories\MediaRepository as MediaContractRepository;
use App\Repositories\MediaRepository;
use App\Contracts\Policies\MediaPolicy as MediaContractPolicy;
use App\Policies\MediaPolicy;
use App\Contracts\Http\Responses\Media\StoreMediaResponse as StoreMediaContractResponse;
use App\Http\Responses\Media\StoreMediaResponse;
use App\Contracts\Http\Responses\Media\ShowMediaResponse as ShowMediaContractResponse;
use App\Http\Responses\Media\ShowMediaResponse;
use App\Contracts\Http\Responses\Media\UserDeletedMediasResponse as UserDeletedMediasContractResponse;
use App\Http\Responses\Media\UserDeletedMediasResponse;

class MediaService implements MediaContractService
{
    public function UserMediasResponse()
    {
        return app()->singleton(UserMediasContractResponse::class, UserMediasResponse::class);
    }

    public function UserDeletedMediasResponse()
    {
        return app()->singleton(UserDeletedMediasContractResponse::class, UserDeletedMediasResponse::class);
    }

    public function StoreMediaResponse()
    {
        return app()->singleton(StoreMediaContractResponse::class, StoreMediaResponse::class);
    }

    public function ShowMediaResponse()
    {
        return app()->singleton(ShowMediaContractResponse::class, ShowMediaResponse::class);
    }

    public function MediaRepository()
    {
        return app()->singleton(MediaContractRepository::class, MediaRepository::class);
    }

    public function MediaPolicy()
    {
        return app()->bind(MediaContractPolicy::class, MediaPolicy::class);
    }

    public function services()
    {
        $this->MediaRepository();
        $this->StoreMediaResponse();
        $this->ShowMediaResponse();
        $this->UserMediasResponse();
        $this->UserDeletedMediasResponse();
        $this->MediaPolicy();
    }
}
