<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Http\Responses\Media\UserMediasResponse;
use App\Contracts\Repositories\MediaRepository;
use App\Facades\Bindings\MediaService;
use App\Http\Requests\StoreMediaRequest;
use App\Contracts\Http\Responses\Media\StoreMediaResponse;

class MediaController extends Controller
{
    public function index(MediaRepository $mediaRepository)
    {
        $data['medias'] = $mediaRepository->getUserMedias(auth()->id());

        return app(UserMediasResponse::class, ['data' => $data]);
    }

    public function store(StoreMediaRequest $request, MediaRepository $mediaRepository)
    {
        $data['media'] = $mediaRepository->createMedia(array_merge($request->validated(), ['user_id' => auth()->id()]));

        return app(StoreMediaResponse::class, ['data' => $data]);
    }
}
