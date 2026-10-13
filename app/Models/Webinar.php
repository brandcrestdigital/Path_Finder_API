<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Webinar extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'date',
        'start_time',
        'end_time',
        'description',
        'added_by',
        'status',
        'restricted_application',
        'meeting_link',

    ];

    protected $casts = [
        'date'       => 'date',
        'start_time' => 'datetime:H:i',
        'end_time'   => 'datetime:H:i',
    ];

    // Auto generate slug
    protected static function booted()
    {
        static::creating(function ($webinar) {
            $baseSlug = Str::slug($webinar->title);
            $slug     = $baseSlug;
            $count    = 1;

            // Make slug unique
            while (Webinar::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $count++;
            }

            $webinar->slug = $slug;
        });
    }

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function applications()
    {
        return $this->hasMany(Application::class);
    }
}