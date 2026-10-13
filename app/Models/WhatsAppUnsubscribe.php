<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WhatsAppUnsubscribe extends Model
{
    public $table = 'whats_app_unsubscribes';

    protected $fillable = [
        'phone',
        'is_active',
        'unsubscribed_at',
        'reason',
    ];

    protected $casts = [
        'is_active'       => 'boolean',
        'unsubscribed_at' => 'datetime',
    ];

    /**
     * Scope to get only active unsubscribed numbers
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope to search by phone
     */
    public function scopePhone($query, $phone)
    {
        return $query->where('phone', $phone);
    }

}
