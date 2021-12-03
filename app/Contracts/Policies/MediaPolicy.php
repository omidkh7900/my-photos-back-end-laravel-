<?php

namespace App\Contracts\Policies;

interface MediaPolicy
{
    public function view($user, $media);
}
