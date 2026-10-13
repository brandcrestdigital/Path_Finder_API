<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'webinar_id',
        'full_name',
        'age',
        'email',
        'phone',
        'country',
        'city',
        'registering_as',
        'current_class',
        'school_college',
        'career_aspiration',
        'reason_for_joining',
        'session_date_time',

        // Professional Fields (New)
        'company_name',
        'designation',
        'years_of_experience',
        'industry',
        'linkedin_profile',

        // Parents
        'father_name',
        'father_occupation',
        'father_phone',
        'father_email',
        'mother_name',
        'mother_occupation',
        'mother_phone',
        'mother_email',

        'status',
        'attendance',
        'added_by',
    ];

    public function webinar()
    {
        return $this->belongsTo(Webinar::class);
    }

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
