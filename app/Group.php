<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
        'name', 'user_id'
    ];

    public function users()
    {
        return $this->hasMany('App\User');
    }
    
    public function groupUsers()
    {
        return $this->belongsToMany('App\User');
    }
}
