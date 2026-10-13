<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffCard extends Model
{
    protected $fillable = [
        'organization_id',
        'user_id',
        'name',
        'designation',
        'phone',
        'slug',
        'email',
        'website',
        'company_name',
        'company_email',
        'profile_image',
        'cover_image',
        'purchase_id',
        'linkedin',
        'instagram',
        'facebook',
        'youtube',
        'company_phone',
        'bio',
        'alternate_phone',
        'whatsapp_number',
        'pincode',
        'country',
        'phone_code',
        'state',
        'city',
        'address',
        'additional_phones',
        'category',
        'completion_score',
    ];

    protected $casts = [
        'additional_phones' => 'array',
    ];

    public function services()
    {
        return $this->hasMany(StaffService::class);
    }

    public function analytics()
    {
        return $this->hasMany(ProfileAnalytics::class, 'card_id');
    }
    public function brochures()
    {
        return $this->hasMany(StaffBrochure::class);
    }

    public function communityImages()
    {
        return $this->hasMany(StaffCommunityImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function digitalCard()
    {
        return $this->hasOne(DigitalCard::class, 'staff_card_id');
    }
}
