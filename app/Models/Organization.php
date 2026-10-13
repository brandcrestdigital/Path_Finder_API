<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Organization extends Model
{
    //

    use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'status',
        'slug',
        'LegalName',
        'GSTNumber',
        'added_by',
    ];

    /* Relationships */

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function cardPurchases()
    {
        return $this->hasMany(OrganizationCardPurchase::class, 'organization_id');
    }

    public function digitalCards()
    {
        return $this->hasMany(DigitalCard::class);
    }

    public function features()
    {
        return $this->hasOne(OrganizationFeature::class);
    }

    public function nfcRequests()
    {
        return $this->hasMany(NfcCardRequest::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($org) {
            $org->slug = Str::slug($org->name);
        });
    }
}
