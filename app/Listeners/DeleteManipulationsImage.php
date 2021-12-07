<?php

namespace App\Listeners;

use App\Events\DeleteMedia;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Contracts\Repositories\MediaRepository;

class DeleteManipulationsImage
{
    public function handle(DeleteMedia $event)
    {
        $mediaRepository = app(MediaRepository::class);
        $mediaRepository->deleteImage($event->media['id'], \App\Models\Media::SMALLIMAGE);
        $mediaRepository->deleteImage($event->media['id'], \App\Models\Media::NORMALIMAGE);
    }
}
