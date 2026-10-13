<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffService extends Model
{
    protected $fillable = [
        'staff_card_id',
        'service_name',
        'service_details',
    ];

    /* ================= RELATIONSHIPS ================= */

    public function staffCard()
    {
        return $this->belongsTo(StaffCard::class, 'staff_card_id');
    }
}
