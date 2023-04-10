<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DateReclamationConfirmation extends Model
{
    use HasFactory;

    protected $fillable = [
        'date',
    ];

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
    public function reclamtionsSuperAdmin()
    {
        return $this->belongsTo(ReclamationSuperAdmin::class);
    }
}
