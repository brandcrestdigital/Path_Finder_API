<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfileAnalytics extends Model
{

    protected $table = 'profile_analytics';

    protected $fillable = [
        'card_id',
        'user_id',
        'action',
        'ip_address',
    ];

    /**
     * Staff Card Relationship
     */
    public function card()
    {
        return $this->belongsTo(StaffCard::class, 'card_id');
    }

    /**
     * User Relationship
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope: Views
     */
    public function scopeViews($query)
    {
        return $query->where('action', 'view');
    }

    /**
     * Scope: Downloads
     */
    public function scopeDownloads($query)
    {
        return $query->where('action', 'download');
    }

    /**
     * Scope: Shares
     */
    public function scopeShares($query)
    {
        return $query->where('action', 'share');
    }

    /**
     * Scope: Meetings
     */
    public function scopeMeetings($query)
    {
        return $query->where('action', 'meeting');
    }
}