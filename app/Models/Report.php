<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    protected $fillable = [
        'reported_user_id',
        'reporter_name',
        'report_details',
        'reported_profile_url',
        'status'
    ];
}