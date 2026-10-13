<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'user_id',
        'ticket_no',
        'department',
        'urgency',

        'control_panel_url',
        'control_panel_username',
        'control_panel_password',

        'subject',
        'message',
        'status',
        'closed_at',
    ];

    protected $casts = [
        'closed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function attachments()
    {
        return $this->hasMany(TicketAttachment::class);
    }

    public function replies()
    {
        return $this->hasMany(TicketReply::class);
    }

}