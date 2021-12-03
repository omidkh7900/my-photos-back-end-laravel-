<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Repositories\MediaRepository;
use Illuminate\Support\Facades\Gate;

class ImageUrlController extends Controller
{
    public function __invoke(int $media, Request $request, MediaRepository $mediaRepository)
    {
        $request->validate([
            'type' => ['string', 'in:' . implode(',', \App\Models\Media::typesOfImage())],
        ]);

        abort_if(Gate::denies('view-media', $mediaRepository->getMedia($media)),
                 403,
                 __('authorize.view_media'));

        return $mediaRepository->getImage($media, $request->type);
    }
}
