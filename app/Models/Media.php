<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

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
}
