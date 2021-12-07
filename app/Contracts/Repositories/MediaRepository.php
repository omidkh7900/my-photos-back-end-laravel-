<?php

namespace App\Contracts\Repositories;

interface MediaRepository
{
    public function getUserMedias(int $userId);

    public function getImage(int $mediaId, string $type);

    public function storeImage(int $mediaId, string $path, string $type);

    public function getMedia(int $mediaId);

    public function createMedia(array $data);
}
