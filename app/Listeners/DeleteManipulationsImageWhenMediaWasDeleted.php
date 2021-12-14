<?php

namespace App\Listeners;

use App\Events\ForceDeleteMedia;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Contracts\Repositories\MediaRepository;

class DeleteManipulationsImageWhenMediaWasDeleted
{
    public function handle(ForceDeleteMedia $event)
    {
        $mediaRepository = app(MediaRepository::class);
        $mediaRepository->deleteImage($event->media['id'], \App\Models\Media::SMALLIMAGE);
        $mediaRepository->deleteImage($event->media['id'], \App\Models\Media::NORMALIMAGE);
    }
}
