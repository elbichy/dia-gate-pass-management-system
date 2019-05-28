<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    use Notifiable;
    protected $guard = 'admin';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 
        'firstname',
        'lastname',
        'email',
        'password',
        'gender',
        'phone',
        'gl',
        'step',
        'rank',
        'position',
        'designation',
        'role',
        'block',
        'office',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function visitors(){
        return $this->hasMany('App\Visitor');
    }

    public function getBlockAttribute($value){
        return strtoupper($value);
    }
}
