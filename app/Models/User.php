<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

  
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    // ];

    protected $guarded=[];

    
    protected $hidden = [
        'password',
        'remember_token',
        'created_at',
        'updated_at',
        'otp',
    ];

    public function GetCon()
    {
        return $this->belongsTo(country::class, 'country_id', 'id');
    }
    public function GetSt()
    {
        return $this->belongsTo(state::class, 'state_id', 'id');
    }

    public function GetAdmin()
    {
        return $this->belongsTo(admin_detail::class, 'blocked_by', 'id');
    }
    
    // protected $casts = [
    //     'email_verified_at' => 'datetime',
    //     'password' => 'hashed',
    // ];
}
