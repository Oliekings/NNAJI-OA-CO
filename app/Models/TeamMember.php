<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'designation',
        'cadre',
        'registration_no',
        'qualifications',
        'experience_years',
        'branch_location',
        'phone',
        'email',
        'bio',
        'education',
        'career_history',
        'key_projects',
        'special_skills',
        'avatar',
        'is_partner',
        'sort_order',
    ];

    protected $casts = [
        'education' => 'array',
        'career_history' => 'array',
        'key_projects' => 'array',
        'special_skills' => 'array',
        'is_partner' => 'boolean',
    ];

    protected static function booted()
    {
        static::creating(function ($member) {
            if (empty($member->slug)) {
                $member->slug = Str::slug($member->name);
            }
        });
    }

    public function scopePartners($query)
    {
        return $query->where('is_partner', true)->orderBy('sort_order', 'asc');
    }

    public function scopeSurveyors($query)
    {
        return $query->where('is_partner', false)->orderBy('sort_order', 'asc');
    }
}
