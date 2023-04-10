<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appartement extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'residence_id'
    ];

    public function residence ()
    {
        return $this->belongsTo(Residence::class);
    }

    public function user ()
    {
        return $this->hasOne(User::class);
    }
}
