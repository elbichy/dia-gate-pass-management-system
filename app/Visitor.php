<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'firstname',
        'lastname',
        'gender',
        'phone',
        'address',
        'verifiedAtGate',
        'verifiedAtReception',
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getGenderAttribute($value){
        return ucfirst($value);
    }
    public function getFirstnameAttribute($value){
        return ucfirst($value);
    }
    public function getLastnameAttribute($value){
        return ucfirst($value);
    }
}
