<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model {

    protected $table = 'news_category';
    public $timestamps = false;

    public static function getAllCategory() {
        return NewsCategory::where('is_active','=',1)
                ->orderBy('name','asc')
                ->get();
    }
    
    public static function getCategory($id) {
        return NewsCategory::find($id);
    }

}
