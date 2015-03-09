<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {

    public $timestamps = false;
    protected $table = 'address';

    public function aimag() {
        return $this->belongsTo('App\Model\Aimag');
    }
}
