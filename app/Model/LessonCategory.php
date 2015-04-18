<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LessonCategory extends Model {

    public $timestamps = false;
    protected $table = 'lesson_category';
    
    public function lessons() {
        return $this->hasMany('App\Model\Lesson');
    }
    
    public static function getLessonCategoryList($param){
        $page = $param['page'];
        $rows = $param['rows'];
        $count = sizeof(LessonCategory::all());
        $offset = ($page - 1) * $rows;
        $name = $param['name'];
        $result = array(
            'rows' => LessonCategory::where('is_active', '=', 1)
                        ->where('name', 'like', '%' . $name . '%')
                        ->skip($offset)
                        ->take($rows)
                        ->orderBy('name', 'asc')
                        ->get(),
            'total' => $count
        );
        
        return $result;
    }
    
}
