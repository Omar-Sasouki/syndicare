<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\HasDatabaseNotifications;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable //implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable , HasRoles ,HasDatabaseNotifications;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'residence_id',
        'appartement_id',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function appartement()
    {
        return $this->belongsTo(Appartement::class);
    }

    public function residence()
    {
        return $this->belongsTo(Residence::class);
    }

    public function picture()
    {
        return $this->hasOne(Picture::class);
    }

    public function reclamtionsuperadmin()
    {
        return $this->hasMany(User::class);
    }
    public function devis()
    {
        return $this->belongsToMany(Devis::class, 'user_devis');
    }
    //check if user isOnline 
    public function isOnline()
    {
        return Cache::has('user-is-online'.$this->id);
    }

}
