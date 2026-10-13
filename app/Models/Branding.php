<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branding extends Model
{
    protected $fillable = [
        'brand_name',
        'logo',
        'favicon',
    ];
}
