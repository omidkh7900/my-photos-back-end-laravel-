<?php

namespace App\Listeners;

use App\Events\CreateMedia;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Jobs\CreateSmallImageForMedia;
use App\Jobs\CreateNormalImageForMedia;

class CreateManipulationsImage
{
    public function handle(CreateMedia $event)
    {
        CreateNormalImageForMedia::dispatch($event->media['id']);
        CreateSmallImageForMedia::dispatch($event->media['id']);
    }
}
