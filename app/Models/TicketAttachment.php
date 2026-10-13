<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketAttachment extends Model
{
    protected $fillable = [
        'ticket_id',
        'file_name',
        'file_path',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    protected $appends = ['file_url'];

    public function getFileUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }
}
