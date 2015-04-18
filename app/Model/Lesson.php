<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\LessonLog;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
class Lesson extends Model {

    public $timestamps = false;
    protected $table = 'lesson';

    public function category() {
        return $this->hasOne('App\Model\LessonCategory');
    }

    public function channel() {
        return $this->hasMany('App\Model\LessonChannel');
    }

    public static function saveLesson($params) {

        $lesson = new Lesson();

        $lesson->lesson_name = $params['lesson_name'];
        $lesson->created_date = $params['created_date'];
        $lesson->lesson_channel_id = $params['lesson_channel_id'];
        $lesson->lesson_category_id = $params['lesson_category_id'];
        $lesson->lesson_content = $params['lesson_content'];
        if ($params['video_url'] != null) {
            $lesson->video_url = $params['video_url'];
        }
        if ($params['ppt_url'] != null) {
            $lesson->ppt_url = $params['ppt_url'];
        }
        $lesson->teacher_id = $params['teacher_id'];
        $isSaved = $lesson->save();

        $lessonLog = new LessonLog();
        $lessonLog->created_date = date('Y-m-d H:i:s');
        $lessonLog->teacher_id = $params['teacher_id'];
        $lessonLog->lesson_id = $lesson->id;
        $lessonLog->action = 'үүсгэсэн';
        $lessonLog->save();

        return $isSaved;
    }

    public static function updateLesson($params, $id) {
        $lesson = Lesson::find($id);

        $lesson->lesson_name = $params['lesson_name'];
        $lesson->updated_date = $params['updated_date'];
        $lesson->lesson_channel_id = $params['lesson_channel_id'];
        $lesson->lesson_category_id = $params['lesson_category_id'];
        $lesson->lesson_content = $params['lesson_content'];
        if ($params['video_url'] != null) {
            $lesson->video_url = $params['video_url'];
        }
        if ($params['ppt_url'] != null) {
            $lesson->ppt_url = $params['ppt_url'];
        }
        $lesson->teacher_id = $params['teacher_id'];
        $isSaved = $lesson->save();

        $lessonLog = new LessonLog();
        $lessonLog->created_date = date('Y-m-d H:i:s');
        $lessonLog->teacher_id = $params['teacher_id'];
        $lessonLog->lesson_id = $lesson->id;
        $lessonLog->action = 'засварласан';
        $lessonLog->save();

        return $isSaved;
    }

    public static function lessonList($params) {
        $page = $params['page'];
        $rows = $params['rows'];
        $channel = $params['channel'];
        $category = $params['category'];
        $title = $params['title'];
        $offset = ($page - 1) * $rows;
        $count = Lesson::all()->count();

        $id = Session::get('teacher')->id;
        $data = Lesson::where('teacher_id', '=', $id)
                ->where('lesson_name', 'LIKE', '%' . $title . '%')
                ->where('lesson_category_id', 'LIKE', '%' . $category . '%')
                ->where('lesson_channel_id', 'LIKE', '%' . $channel . '%')
                ->join('lesson_category', 'lesson_category_id', '=', 'lesson_category.id')
                ->join('lesson_channel', 'lesson_channel_id', '=', 'lesson_channel.id')
                ->select('lesson.id', 'lesson.lesson_name', 'lesson.lesson_content', 'lesson.created_date', 'lesson.updated_date', 'lesson_category.name as categoryname', 'lesson_channel.name as channelname')
                ->skip($offset)
                ->take($rows)
                ->get();

        $result = array(
            'rows' => $data,
            'total' => $count
        );
        return $result;
    }

    public static function allLessons($params) {
        $page = $params['page'];
        $rows = $params['rows'];
        $channel = $params['channel'];
        $category = $params['category'];
        $title = $params['title'];
        $offset = ($page - 1) * $rows;
        $count = Lesson::all()->count();

        $data = DB::table('lesson')
                ->where('lesson_name', 'LIKE', '%' . $title . '%')
                ->where('lesson_category_id', 'LIKE', '%' . $category . '%')
                ->where('lesson_channel_id', 'LIKE', '%' . $channel . '%')
                ->join('lesson_category', 'lesson_category_id', '=', 'lesson_category.id')
                ->join('lesson_channel', 'lesson_channel_id', '=', 'lesson_channel.id')
                ->join('teacher','teacher_id','=','teacher.id')
                ->join('teacher_info','teacher.id','=','teacher_info.teacher_id')
                ->select('lesson.id', 'lesson.lesson_name', 'lesson.lesson_content', 'lesson.created_date', 'lesson.updated_date', 
                        'lesson_category.name as categoryname', 'lesson_channel.name as channelname','teacher_info.firstname as teachername')
                ->skip($offset)
                ->take($rows)
                ->get();

        $result = array(
            'rows' => $data,
            'total' => $count
        );
        return $result;
    }

}
