<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeReclamation extends Model
{
    use HasFactory;

    public function reclamtion ()
    {
        return $this->hasOne(ReclamationSuperAdmin::class);
    }
    public function reclamtionAdmin ()
    {
        return $this->hasOne(ReclamationAdmin::class);
    }

}
