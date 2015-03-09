<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Aimag extends Model {

    public $timestamps = false;
    protected $table = 'aimag';
    
    public function districts() {
        return $this->hasMany('App\Model\District');
    }
}
