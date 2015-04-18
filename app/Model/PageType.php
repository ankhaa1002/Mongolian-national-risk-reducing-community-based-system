<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PageType extends Model {

    public $timestamps = false;
    protected $table = 'page_type';

    public function pages() {
        return $this->hasMany('App\Model\Page');
    }

}
