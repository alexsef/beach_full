<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function getUpdatedAtAttribute($value) {
        return Carbon::parse($value)->format("d/m/Y");
    }
}
