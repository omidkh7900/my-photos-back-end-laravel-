<?php

namespace App\Contracts\Services;

interface Image
{
    public function load(string $path);

    public function optimize(string $path = null);

    public function makeNormalImage(string $path = null);

    public function makeSmallImage(string $path = null);
}
