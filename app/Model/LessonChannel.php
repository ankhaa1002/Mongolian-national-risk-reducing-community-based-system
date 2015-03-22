<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class LessonChannel extends Model {

    public $timestamps = false;
    protected $table = 'lesson_channel';

    public static function getLessonChannelList($param) {
        $page = $param['page'];
        $rows = $param['rows'];
        $count = sizeof(LessonChannel::all());
        $offset = ($page - 1) * $rows;
        $name = $param['name'];
        $result = array(
            'rows' => LessonChannel::where('is_active', '=', 1)
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
