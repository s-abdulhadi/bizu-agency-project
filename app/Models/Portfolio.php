<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'title',
        'slug',
        'client_name',
        'description',
        'cover_image',
        'images',
        'tags',
    ];

    protected $casts = [
        'images' => 'array',
        'tags' => 'array',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
