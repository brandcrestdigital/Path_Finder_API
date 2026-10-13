<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationFeature extends Model
{
    protected $fillable = [
        'organization_id',
        'templates_module',
        'community_logos',
        'custom_branding',
        'template_customization',
    ];

    protected $casts = [
        'templates_module'       => 'boolean',
        'community_logos'        => 'boolean',
        'custom_branding'        => 'boolean',
        'template_customization' => 'boolean',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }
}
