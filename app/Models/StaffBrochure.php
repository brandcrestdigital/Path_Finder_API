<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffBrochure extends Model
{
    protected $table = 'staff_brochures';

    protected $fillable = [
        'staff_card_id',
        'file_path',
        'name',
    ];

    /* ================= RELATIONSHIPS ================= */

    public function staffCard()
    {
        return $this->belongsTo(StaffCard::class, 'staff_card_id');
    }

    /* ================= ACCESSOR ================= */

    public function getFileUrlAttribute()
    {
        return $this->file_path
            ? asset('storage/' . $this->file_path)
            : null;
    }
}
