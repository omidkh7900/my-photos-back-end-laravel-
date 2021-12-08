<?php

namespace App\Http\Responses\Media;

use App\Contracts\Http\Responses\Media\UserDeletedMediasResponse as UserDeletedMediasContractResponse;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\MediaCollection;

class UserDeletedMediasResponse implements UserDeletedMediasContractResponse
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
