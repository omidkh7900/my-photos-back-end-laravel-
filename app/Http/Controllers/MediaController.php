<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contracts\Http\Responses\Media\UserMediasResponse;
use App\Contracts\Repositories\MediaRepository;
use App\Facades\Bindings\MediaService;

class MediaController extends Controller
{
    public function index(MediaRepository $mediaRepository)
    {
        $data['medias'] = $mediaRepository->getUserMedias(auth()->id());

        return app(UserMediasResponse::class, ['data' => $data]);
    }
}
