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

    public function getUserDeletedMedias(int $userId)
    {
        Paginator::currentPageResolver(fn () => request()->media_page);
        $medias = Media::onlyTrashed()
                        ->select(['id', 'name', 'file_name', 'mime_type'])
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
           'name' => $data['name'] ?? $data['media']->getClientOriginalName(),
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

    public function storeImage(int $mediaId, string $path, string $type)
    {
        if (! Media::isTypesOfImage($type)) {
            throw new \App\Exceptions\WrongTypeOfImage;
        }
        $media = Media::find($mediaId);

        $file = new \Illuminate\Http\UploadedFile($path, $media->file_name);

        $media->update([
            "manipulations" => array_merge($media->manipulations, ["$type" => $file->store('medias')]),
        ]);
    }

    public function deleteImage(int $mediaId, string $type)
    {
        if (! Media::isTypesOfImage($type)) {
            throw new \App\Exceptions\WrongTypeOfImage;
        }
        $media = Media::withTrashed()->findOrFail($mediaId);
        $media->deleteImage($type);
        $media->update([
            'manipulations' => array_merge($media->manipulations, [$type => null]),
        ]);
    }

    public function deleteMedia(int $mediaId)
    {
        $media = Media::findOrFail($mediaId);
        $media->delete();
    }
}
