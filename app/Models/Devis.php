<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devis extends Model
{
    use HasFactory;

    protected $fillable = ['pdf', 'item','price', 'Quantity', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
