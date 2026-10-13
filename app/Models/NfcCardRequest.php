<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NfcCardRequest extends Model
{
 
    protected $fillable = [
        'organization_id',
        'purchase_id',

        'card_link',

        'address_line1',
        'address_line2',
        'landmark',

        'pincode',
        'city',
        'district',
        'state',
        'country',

        'remarks',

        'status',
        'rejected_reason',

        'approved_by',
        'approved_at',
    ];

    protected $casts = [
        'approved_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function purchase()
    {
        return $this->belongsTo(OrganizationCardPurchase::class, 'purchase_id');
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function isPending()
    {
        return $this->status === 'pending';
    }

    public function isApproved()
    {
        return $this->status === 'approved';
    }

    public function isRejected()
    {
        return $this->status === 'rejected';
    }

    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    public function canEdit()
    {
        return in_array($this->status, ['pending', 'rejected']);
    }
 
 
}
