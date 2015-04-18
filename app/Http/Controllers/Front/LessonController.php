<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PageType;
use Illuminate\Support\Facades\DB;
use App\Model\LessonChannel;
use App\Model\LessonCategory;
use App\Model\Lesson;
use App\Model\Config;

class LessonController extends Controller {

    public $pageTypes = null;
    public $categories = null;
    public $channels = null;
    public $config = null;
    
    public function __construct() {
        $this->pageTypes = PageType::orderBy('order', 'ASC')->get();
        $this->categories = LessonCategory::all();
        $this->channels = LessonChannel::all();
        $this->config = Config::find(777);
    }

    public function index() {
        $view = view('front.lesson.index');
        $view->title = 'Хичээлийн жагсаалт';
        $view->pageTypes = $this->pageTypes;
        $lessons = DB::table('lesson')
                ->join('teacher', 'lesson.teacher_id', '=', 'teacher.id')
                ->join('teacher_info', 'teacher.id', '=', 'teacher_info.teacher_id')
                ->join('lesson_channel', 'lesson.lesson_channel_id', '=', 'lesson_channel.id')
                ->join('lesson_category', 'lesson.lesson_category_id', '=', 'lesson_category.id')
                ->orderBy('created_date', 'desc')
                ->select('lesson.lesson_name as name', 'lesson.lesson_content', 'lesson.id', 'lesson.created_date', 'teacher_info.firstname as teacher_name', 'teacher.id as teacher_id', 'lesson_channel.id as channel_id', 'lesson_channel.name as channel_name', 'lesson_category.id as category_id', 'lesson_category.name as category_name', 'teacher_info.portrait_image as image')
                ->paginate($this->config->lesson_per_page);
        $lessons->setPath('');
        $view->categories = $this->categories;
        $view->channels = $this->channels;
        $view->lessons = $lessons;
        $view->config = $this->config;
        return $view;
    }

    public function show($id) {
        $lesson = DB::table('lesson')
                ->where('lesson.id','=',$id)
                ->join('teacher', 'lesson.teacher_id', '=', 'teacher.id')
                ->join('teacher_info', 'teacher.id', '=', 'teacher_info.teacher_id')
                ->join('lesson_channel', 'lesson.lesson_channel_id', '=', 'lesson_channel.id')
                ->join('lesson_category', 'lesson.lesson_category_id', '=', 'lesson_category.id')
                ->orderBy('created_date', 'desc')
                ->select('lesson.lesson_name as name', 'lesson.lesson_content', 'lesson.id', 'lesson.created_date', 'teacher_info.firstname as teacher_name','teacher_info.lastname as teacher_lastname', 
                        'teacher.id as teacher_id', 'lesson_channel.id as channel_id', 'lesson_channel.name as channel_name', 'lesson_category.id as category_id', 
                        'lesson_category.name as category_name', 'teacher_info.portrait_image as image','lesson.ppt_url','lesson.video_url','teacher_info.email')
                ->get();
        $view = view('front.lesson.show');
        $view->categories = $this->categories;
        $view->channels = $this->channels;
        $view->pageTypes = $this->pageTypes;
        $view->lesson = isset($lesson[0]) ? $lesson[0] : null;
        $view->config = $this->config;
        return $view;
    }

}
