<?php

namespace App\Contracts\Services\Bindings;

interface MediaService
{
    public function UserMediasResponse();

    public function UserDeletedMediasResponse();

    public function StoreMediaResponse();

    public function ShowMediaResponse();

    public function MediaRepository();

    public function MediaPolicy();

    public function services();
}
