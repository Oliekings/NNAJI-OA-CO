<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'reference_no',
        'property_type',
        'listing_type',
        'price',
        'price_prefix',
        'price_unit',
        'location_address',
        'location_city',
        'location_state',
        'bedrooms',
        'bathrooms',
        'land_area',
        'building_area',
        'description',
        'features',
        'featured_image',
        'gallery_images',
        'status',
        'sold_price',
        'sold_date',
        'client_name',
        'transaction_summary',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'sold_price' => 'decimal:2',
        'sold_date' => 'date',
        'is_featured' => 'boolean',
        'features' => 'array',
        'gallery_images' => 'array',
    ];

    protected static function booted()
    {
        static::creating(function ($property) {
            if (empty($property->slug)) {
                $property->slug = Str::slug($property->title) . '-' . Str::random(5);
            }
            if (empty($property->reference_no)) {
                $property->reference_no = 'NOA-' . strtoupper(Str::random(6));
            }
        });
    }

    // Lifecycle Scopes
    public function scopeActive($query)
    {
        return $query->whereIn('status', ['available', 'under_offer']);
    }

    public function scopeClosedDeals($query)
    {
        return $query->whereIn('status', ['sold', 'leased', 'valuation_closed']);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getCurrencySymbolAttribute(): string
    {
        return match(strtoupper(trim($this->price_prefix ?? '₦'))) {
            '$', 'USD', 'DOLLAR', 'DOLLARS' => '$',
            '€', 'EUR', 'EURO', 'EUROS' => '€',
            '£', 'GBP', 'POUND', 'POUNDS' => '£',
            default => $this->price_prefix ?: '₦',
        };
    }

    public function getCurrencyCodeAttribute(): string
    {
        return match(strtoupper(trim($this->price_prefix ?? '₦'))) {
            '$', 'USD', 'DOLLAR', 'DOLLARS' => 'USD',
            '€', 'EUR', 'EURO', 'EUROS' => 'EUR',
            '£', 'GBP', 'POUND', 'POUNDS' => 'GBP',
            default => 'NGN',
        };
    }

    public function getFormattedPriceAttribute(): string
    {
        if (!$this->price || $this->price == 0) {
            return 'Price on Application (POA)';
        }
        $formatted = $this->currency_symbol . number_format($this->price, 0, '.', ',');
        if ($this->price_unit) {
            $formatted .= ' ' . $this->price_unit;
        }
        return $formatted;
    }

    public function getFormattedSoldPriceAttribute(): ?string
    {
        if (!$this->sold_price) return null;
        return $this->currency_symbol . number_format($this->sold_price, 0, '.', ',');
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'available' => 'bg-emerald-100 text-emerald-800 border-emerald-300',
            'under_offer' => 'bg-amber-100 text-amber-800 border-amber-300',
            'sold' => 'bg-red-100 text-red-800 border-red-300',
            'leased' => 'bg-blue-100 text-blue-800 border-blue-300',
            'valuation_closed' => 'bg-slate-100 text-slate-800 border-slate-300',
            default => 'bg-gray-100 text-gray-800 border-gray-300',
        };
    }

    public function getStatusLabelAttribute(): string
    {
        return match ($this->status) {
            'available' => 'Active Listing',
            'under_offer' => 'Under Offer',
            'sold' => 'Closed Deal / Sold',
            'leased' => 'Successfully Leased',
            'valuation_closed' => 'Valuation Completed',
            default => ucfirst($this->status),
        };
    }

    public function getFeaturedImageAttribute(?string $value): ?string
    {
        return \App\Support\MediaUrl::normalize($value);
    }

    public function getGalleryImagesAttribute($value): array
    {
        return \App\Support\MediaUrl::normalizeArray($value);
    }

    public function inquiries()
    {
        return $this->hasMany(Inquiry::class);
    }
}
