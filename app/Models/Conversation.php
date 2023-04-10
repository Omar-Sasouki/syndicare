<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable=['user_id','seconde_user_id','message'];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
