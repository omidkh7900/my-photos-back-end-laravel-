<?php

namespace App\Http\Responses\Media;

use App\Contracts\Http\Responses\Media\UserMediasResponse as UserMediasContractResponse;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\MediaCollection;

class UserMediasResponse implements UserMediasContractResponse
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function toResponse($request)
    {
        return $request->wantsJson()
             ? new JsonResponse([
                 'data' => [
                    'medias' => new MediaCollection($this->data['medias']),
                 ],
             ], 200)
             : null;
    }
}
