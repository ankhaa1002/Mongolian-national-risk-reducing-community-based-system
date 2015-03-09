<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model {

    protected $table = 'news_category';
    public $timestamps = false;

    public static function getAllCategory($name, $param) {
        $page = $param['page'];
        $rows = $param['rows'];
        $count = sizeof(NewsCategory::all());
        $offset = ($page - 1) * $rows;
        $result = array(
            'rows' => NewsCategory::where('is_active', '=', 1)
                        ->where('name', 'like', '%' . $name . '%')
                        ->skip($offset)
                        ->take($rows)
                        ->orderBy('name', 'asc')
                        ->get(),
            'total' => $count
        );
        return $result;
    }

    public static function getCategory($id) {
        return NewsCategory::find($id);
    }

}
