<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffCommunityImage extends Model
{
    protected $table = 'staff_community_images';

    protected $fillable = [
        'staff_card_id',
        'image_path',
        'name',
    ];

    /* ================= RELATIONSHIP ================= */

    public function staffCard()
    {
        return $this->belongsTo(StaffCard::class, 'staff_card_id');
    }

    /* ================= ACCESSOR ================= */

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        return $this->image_path
            ? asset('storage/' . $this->image_path)
            : null;
    }
}
