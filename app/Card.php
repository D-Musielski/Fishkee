<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    public function collections()
    {
        return $this->belongsToMany('App\Collection');
    }
}
