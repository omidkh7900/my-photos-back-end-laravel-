<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory, SoftDeletes;

    const SMALLIMAGE = 'small';
    const NORMALIMAGE = 'normal';
    const LARGEIMAGE = 'large';
    const ORIGINALIMAGE = 'original';

    protected $fillable = [
        'user_id',
        'name',
        'file_name',
        'mime_type',
        'size',
        'manipulations',
    ];

    protected $casts = [
        'manipulations' => 'array',
    ];

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function manipulationImage($type)
    {
        if(! $this->isTypesOfImage($type)) {
            return null;
        }

        return Storage::download($this->manipulations[$type]);
    }

    public static function typesOfImage()
    {
        return [
            self::SMALLIMAGE,
            self::NORMALIMAGE,
            self::LARGEIMAGE,
            self::ORIGINALIMAGE,
        ];
    }

    public function isTypesOfImage($type)
    {
        return in_array($type, $this::typesOfImage());
    }
}
