<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Http\Responses\Media\UserMediasResponse;
use App\Contracts\Repositories\MediaRepository;
use App\Facades\Bindings\MediaService;
use App\Http\Requests\StoreMediaRequest;
use App\Contracts\Http\Responses\Media\StoreMediaResponse;
use App\Events\CreateMedia;
use App\Contracts\Http\Responses\Media\ShowMediaResponse;
use Illuminate\Support\Facades\Gate;

class MediaController extends Controller
{
    public function index(MediaRepository $mediaRepository)
    {
        $data['medias'] = $mediaRepository->getUserMedias(auth()->id());

        return app(UserMediasResponse::class, ['data' => $data]);
    }

    public function show(MediaRepository $mediaRepository, $media)
    {
        $data['media'] = $mediaRepository->getMedia($media);

        abort_if(Gate::denies('view-media', $data['media']),
                 403,
                 __('authorize.view_media'));

        return app(ShowMediaResponse::class, ['data' => $data]);
    }

    public function store(StoreMediaRequest $request, MediaRepository $mediaRepository)
    {
        $data['media'] = $mediaRepository->createMedia(array_merge($request->validated(), ['user_id' => auth()->id()]));

        event(new CreateMedia($data['media']));

        return app(StoreMediaResponse::class, ['data' => $data]);
    }
}
