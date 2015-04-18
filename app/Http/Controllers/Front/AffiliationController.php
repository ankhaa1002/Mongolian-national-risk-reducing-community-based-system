<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\PageType;
use Illuminate\Http\Request;
use App\Model\LessonCategory;
use App\Model\LessonChannel;
use App\Model\Lesson;
use App\Model\Aimag;
use App\Model\District;
use Illuminate\Support\Facades\DB;
use App\Model\Config;

class AffiliationController extends Controller {

    public $config = null;
    
    public function __construct() {
        $this->config = Config::find(777);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function showAimag($id) {
        $aimag = Aimag::find($id);
        $view = view('front.lesson.aimag.show');
        $view->title = $aimag->name . ' аймаг';
        $view->pageTypes = PageType::orderBy('order', 'ASC')->get();
        $lessons = DB::table('lesson')
                ->where('address.aimag_id', '=', $id)
                ->join('teacher', 'lesson.teacher_id', '=', 'teacher.id')
                ->join('teacher_info', 'teacher.id', '=', 'teacher_info.teacher_id')
                ->join('address', 'teacher_info.id', '=', 'address.teacher_info_id')
                ->join('lesson_channel', 'lesson.lesson_channel_id', '=', 'lesson_channel.id')
                ->join('lesson_category', 'lesson.lesson_category_id', '=', 'lesson_category.id')
                ->orderBy('created_date', 'desc')
                ->select('lesson.lesson_name as name', 'lesson.lesson_content', 'lesson.id', 'lesson.created_date', 'teacher_info.firstname as teacher_name', 'teacher_info.lastname as teacher_lastname', 'teacher.id as teacher_id', 'lesson_channel.id as channel_id', 'lesson_channel.name as channel_name', 'lesson_category.id as category_id', 'lesson_category.name as category_name', 'teacher_info.portrait_image as image', 'lesson.ppt_url', 'lesson.video_url', 'teacher_info.email')
                ->paginate(20);
        $lessons->setPath('');
        $view->lessons = $lessons;
        $view->categories = LessonCategory::all();
        $view->channels = LessonChannel::all();
        $view->config = $this->config;

        return $view;
    }

    public function showDistrict($id) {
        $district = District::find($id);
        $view = view('front.lesson.district.show');
        $view->title = $district->name . ' дүүрэг';
        $view->pageTypes = PageType::orderBy('order', 'ASC')->get();
        $lessons = DB::table('lesson')
                ->where('address.district_id', '=', $id)
                ->join('teacher', 'lesson.teacher_id', '=', 'teacher.id')
                ->join('teacher_info', 'teacher.id', '=', 'teacher_info.teacher_id')
                ->join('address', 'teacher_info.id', '=', 'address.teacher_info_id')
                ->join('lesson_channel', 'lesson.lesson_channel_id', '=', 'lesson_channel.id')
                ->join('lesson_category', 'lesson.lesson_category_id', '=', 'lesson_category.id')
                ->orderBy('created_date', 'desc')
                ->select('lesson.lesson_name as name', 'lesson.lesson_content', 'lesson.id', 'lesson.created_date', 'teacher_info.firstname as teacher_name', 'teacher_info.lastname as teacher_lastname', 'teacher.id as teacher_id', 'lesson_channel.id as channel_id', 'lesson_channel.name as channel_name', 'lesson_category.id as category_id', 'lesson_category.name as category_name', 'teacher_info.portrait_image as image', 'lesson.ppt_url', 'lesson.video_url', 'teacher_info.email')
                ->paginate(20);
        $lessons->setPath('');
        $view->lessons = $lessons;
        $view->categories = LessonCategory::all();
        $view->channels = LessonChannel::all();
        $view->config = $this->config;
        return $view;
    }

}
