<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    public function language()
    {
        return $this->belongsTo('App\Language');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }
}
