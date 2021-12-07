<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Contracts\Repositories\MediaRepository;
use App\Facades\Supports\Image;

class CreateSmallImageForMedia implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $mediaId;

    public function __construct($mediaId)
    {
        $this->mediaId = $mediaId;
    }

    public function handle(MediaRepository $mediaRepository)
    {
        $extention = $mediaRepository->getMedia($this->mediaId)['mime_type'];
        $path = $this->getTempPath($extention);
        $this->makeFile($path, $mediaRepository);
        Image::load($path)->optimize()->makeSmallImage();

        $mediaRepository->storeImage($this->mediaId, $path, \App\Models\Media::SMALLIMAGE);
    }

    public function getTempPath($extention)
    {
        return '/tmp/'.\Illuminate\Support\Str::random(32). '.' . $extention;
    }

    public function makeFile($path, $mediaRepository)
    {
        file_put_contents($path, $mediaRepository->getImage($this->mediaId, \App\Models\Media::ORIGINALIMAGE));
    }
}
