<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function child() {
        return $this->hasMany('App\Page', 'parent_id', 'page_id');
    }

    public function parent() {
        return $this->belongsTo('App\Page', 'parent_id', 'page_id');
    }
}
