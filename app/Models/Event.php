<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    public function user() {
        return $this->belongsTo(User::class);
    }

    // In your Event model
    public function subscribers()
    {
        return $this->belongsToMany(User::class, 'event_user', 'event_id', 'user_id')->withPivot('user_name', 'event_name')->withTimestamps();
    }

    protected $dates = ['event_date'];
    protected $fillable = [
        'title', 
        'Type_de_billet', 
        'event_date', 
        'location', 
        'price', 
        'description', 
        'image_path', 
        'duration',
        'max_subscribers',
        'closed',
        'map_url'
        
    ];
    protected $casts = [
        'event_date' => 'datetime',
        'closed' => 'boolean',
    ];
    public function getSubscribersCountAttribute()
    {
        $userSubscribers = $this->subscribers()->count();
        $guestSubscribers = $this->guestSubscriptions()->count();
        return $userSubscribers + $guestSubscribers;
    }
    public function hasMultipleDates()
    {
        return Event::where('title', $this->title)
                    ->where('id', '!=', $this->id)
                    ->exists();
    }
    public function guestSubscriptions()
    {
        return $this->hasMany(GuestSubscription::class);
    }
}