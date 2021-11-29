<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Media;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class MediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Storage::makeDirectory('medias');

        Media::factory(5)->state(function ($attributes) {
            return [
                'user_id' => User::inRandomOrder()->first()->id,
            ];
        })->create();
    }
}
