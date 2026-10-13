<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $fillable = [
        'organization_id',
        'brand_name',
        'logo',
        'cover_page',
        'template_change',
        'cover_change',
        'custom_community_logo',
    ];

    protected $casts = [
        'template_change'       => 'boolean',
        'cover_change'          => 'boolean',
        'custom_community_logo' => 'boolean',
    ];
}
