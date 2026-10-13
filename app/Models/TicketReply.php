<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    protected $fillable = [
        'ticket_id',
        'user_id',
        'sender_type',
        'message',
        'attachment',
    ];

    protected $appends = ['attachment_url'];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getAttachmentUrlAttribute()
    {
        return $this->attachment
            ? asset('storage/' . $this->attachment)
            : null;
    }
}
