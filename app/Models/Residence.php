<?php

namespace App\Models;

use App\Notifications\TableUpdatedNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Residence extends Model
{
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        'name',
        'event1',
        'event_title1',
        'event2',
        'event_title2',
        'event3',
        'event_title3',
    ];


    public function user()
    {
        return $this->hasMany(User::class);
    }
    public function appartement()
    {
        return $this->hasMany(Appartement::class);
    }
}
