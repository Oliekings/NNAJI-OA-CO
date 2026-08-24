<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'property_id',
        'name',
        'email',
        'phone',
        'organization',
        'subject',
        'service_category',
        'asset_type',
        'asset_location',
        'preferred_branch',
        'message',
        'status',
        'admin_notes',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'new' => 'bg-emerald-100 text-emerald-800',
            'in_review' => 'bg-amber-100 text-amber-800',
            'contacted' => 'bg-blue-100 text-blue-800',
            'completed' => 'bg-purple-100 text-purple-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}
