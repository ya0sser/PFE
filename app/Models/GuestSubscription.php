<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GuestSubscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'email', 'username', 'phone', 'event_id'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }
}
