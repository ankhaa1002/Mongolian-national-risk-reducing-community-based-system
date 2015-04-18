<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\LessonChannel;
use Illuminate\Http\Request;
use App\Model\PageType;
use App\Model\LessonCategory;
use Illuminate\Support\Facades\DB;
use App\Model\Config;

class LessonChannelController extends Controller {

    public $config = null;
    
    public function __construct() {
        $this->config = Config::find(777);
    }
    
    public function show($id) {
        $channel = LessonChannel::find($id);
        $lessons = DB::table('lesson')
                ->where('lesson.lesson_channel_id', '=', $id)
                ->join('teacher', 'lesson.teacher_id', '=', 'teacher.id')
                ->join('teacher_info', 'teacher.id', '=', 'teacher_info.teacher_id')
                ->join('lesson_channel', 'lesson.lesson_channel_id', '=', 'lesson_channel.id')
                ->join('lesson_category', 'lesson.lesson_category_id', '=', 'lesson_category.id')
                ->orderBy('created_date', 'desc')
                ->select('lesson.lesson_name as name', 'lesson.lesson_content', 'lesson.id', 'lesson.created_date', 'teacher_info.firstname as teacher_name', 'teacher_info.lastname as teacher_lastname', 'teacher.id as teacher_id', 'lesson_channel.id as channel_id', 'lesson_channel.name as channel_name', 'lesson_category.id as category_id', 'lesson_category.name as category_name', 'teacher_info.portrait_image as image', 'lesson.ppt_url', 'lesson.video_url', 'teacher_info.email')
                ->paginate($this->config->lesson_per_page);
        $lessons->setPath('');
        $view = view('front.lesson.channel.show');
        $view->pageTypes = PageType::orderBy('order', 'ASC')->get();
        $view->title = $channel->name;
        $view->lessons = $lessons;
        $view->categories = LessonCategory::all();
        $view->channels = LessonChannel::all();
        $view->config = $this->config;
        return $view;
    }

}
