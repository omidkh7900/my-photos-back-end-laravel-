<?php

namespace App\Repositories;

use App\Contracts\Repositories\MediaRepository as MediaContractRepository;
use App\Models\Media;
use Illuminate\Pagination\Paginator;

class MediaRepository implements MediaContractRepository
{
    public function getUserMedias(int $userId)
    {
        Paginator::currentPageResolver(fn () => request()->media_page);
        $medias = Media::select(['id', 'name', 'file_name', 'mime_type'])
                        ->where('user_id', $userId)
                        ->paginate(9)
                        ->setPageName('media_page');

        return $medias;
    }

    public function getImage(int $mediaId, string $type)
    {
        $media = Media::select('manipulations')->findOrFail($mediaId);

        return $media->manipulationImage($type);
    }

    public function getMedia(int $mediaId)
    {
        return Media::findOrFail($mediaId);
    }

    public function createMedia(array $data)
    {
        $media = Media::create([
           'name' => $data['name'],
           'user_id' => $data['user_id'],
           'file_name' => $data['media']->getClientOriginalName(),
           'size' => $data['media']->getSize(),
           'mime_type' => $data['media']->extension(),
           'manipulations' => [
                    'original' => $data['media']->store('medias'),
                ]
        ]);
        return $media;
    }
}