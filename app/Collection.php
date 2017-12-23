<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{

    protected $fillable = [
        'name',
        'language_id',
        'category_id',
        'user_id'
    ];

    public function language()
    {
        return $this->belongsTo('App\Language');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function cards()
    {
        return $this->belongsToMany('App\Card');
    }

    public function userCollections($id)
    {
        return $this->where('user_id', $id)->get();
    }
}
