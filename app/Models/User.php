<?php
namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */

    // use SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'organization_id',
        'role',
        'google_id',
        'google_token',
        'google_refresh_token',
        'avatar',

        'google_token_expires_at',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function digitalCards()
    {
        return $this->hasMany(DigitalCard::class);
    }
    protected $guarded = [

    ];

    public function profileAnalytics()
    {
        return $this->hasMany(ProfileAnalytics::class);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    protected $casts = [
        'google_token_expires_at' => 'datetime',
    ];

    public function approvedNfcRequests()
    {
        return $this->hasMany(NfcCardRequest::class, 'approved_by');
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    public function staffCard()
    {
        return $this->hasOne(StaffCard::class);
    }

    public function meetings()
    {
        return $this->hasMany(Meeting::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
