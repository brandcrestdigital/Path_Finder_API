<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $fillable = [
        'user_id',
        'requester_name',
        'requester_email',
        'title',
        'description',
        'meeting_date',
        'meeting_time',
        'status',
        'meet_link',
        'google_event_id',
        'company_name',
        'cancelled_by',
        'cancelled_remarks',
        'cancelled_at',
        'phone',
          'meeting_type',
    'location',
    ];

    // Staff receiving meeting
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $casts = [
        // 'meeting_date' => 'date',
        'cancelled_at' => 'datetime',
    ];
}
