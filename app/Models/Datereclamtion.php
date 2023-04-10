<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datereclamtion extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
    ];


    public function reclamtionsSuperAdmin()
    {
        return $this->belongsTo(ReclamationSuperAdmin::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

