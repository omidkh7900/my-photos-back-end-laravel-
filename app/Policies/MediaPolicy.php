<?php

namespace App\Policies;

use App\Models\User;
use App\Contracts\Policies\MediaPolicy as MediaContractPolicy;

class MediaPolicy implements MediaContractPolicy
{
    public function view($user, $media)
    {
        if($user['id'] == $media['user_id'])
            return true;

        return false;
    }
}
