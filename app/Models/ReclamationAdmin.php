<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReclamationAdmin extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'object',
        'payload',
        'type',
    ];

    /**
     * Get the user that owns the ReclamationSuperAdmin
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(TypeReclamation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
   
}
