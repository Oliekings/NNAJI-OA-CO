<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'icon',
        'subtitle',
        'short_description',
        'full_description',
        'scope_of_work',
        'asset_classes',
        'featured_image',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'scope_of_work' => 'array',
        'asset_classes' => 'array',
        'is_active' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($service) {
            if (empty($service->slug)) {
                $service->slug = Str::slug($service->title);
            }
        });
    }

    public function getFeaturedImageAttribute(?string $value): ?string
    {
        return \App\Support\MediaUrl::normalize($value);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true)->orderBy('sort_order', 'asc');
    }
}
