<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;

class MediaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $mimeType = $this->fakeMimeType();

        $path = $this->faker->image(storage_path('app/medias'));
        $originalFilePath = $this->originalFilePath($path);
        $originalFileSize = Storage::size($originalFilePath);

        return [
            'name' => $this->faker->name(),
            'file_name' => $this->faker->name() . '.' . $mimeType,
            'mime_type' => $mimeType,
            'size' => $originalFileSize,
            'manipulations' => json_encode([
                'small' => $this->originalFilePath($this->faker->image(storage_path('app/medias'), 100, 100)),
                'normal' => $this->originalFilePath($this->faker->image(storage_path('app/medias'), 250, 250)),
                'large' => $this->originalFilePath($this->faker->image(storage_path('app/medias'), 500, 500)),
                'original' => $originalFilePath,
            ]),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function originalFilePath($path)
    {
        return str_replace(storage_path() . '/app/', '', $path);
    }

    public function fakeMimeType()
    {
        return $this->mimeTypes()[random_int(0, count($this->mimeTypes()) - 1 )];
    }

    public function mimeTypes()
    {
        return [
          'jpeg',
          'png',
          'svg',
          'jpg',
          'gif',
          'webp',
        ];
    }
}
