<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\CreateMedia;
use App\Listeners\CreateManipulationsImage;
use App\Events\DeleteMedia;
use App\Listeners\DeleteManipulationsImage;
use App\Events\ForceDeleteMedia;
use App\Listeners\DeleteOriginalImageWhenMediaWasDeleted;
use App\Listeners\DeleteManipulationsImageWhenMediaWasDeleted;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CreateMedia::class => [
            CreateManipulationsImage::class,
        ],
        DeleteMedia::class => [
            DeleteManipulationsImage::class,
        ],
        ForceDeleteMedia::class => [
            DeleteManipulationsImageWhenMediaWasDeleted::class,
            DeleteOriginalImageWhenMediaWasDeleted::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
