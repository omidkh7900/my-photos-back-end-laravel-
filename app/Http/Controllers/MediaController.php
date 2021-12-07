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
use App\Events\DeleteMedia;

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

    public function destroy(MediaRepository $mediaRepository, $media)
    {
        $data['media'] = $mediaRepository->getMedia($media);

        abort_if(Gate::denies('delete-media', $data['media']),
                 403,
                 __('authorize.delete_media'));

        $mediaRepository->deleteMedia($media);

        event(new DeleteMedia($data['media']));

        return response()->json([], 200);
    }
}
