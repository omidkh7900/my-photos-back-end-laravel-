<?php

namespace App\Contracts\Services\Bindings;

interface MediaService
{
    public function UserMediasResponse();

    public function StoreMediaResponse();

    public function ShowMediaResponse();

    public function MediaRepository();

    public function MediaPolicy();

    public function services();
}
