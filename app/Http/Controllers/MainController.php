<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\PageType;
use Illuminate\Http\Request;
use App\Model\News;
use Illuminate\Support\Facades\DB;
use App\Model\LessonChannel;
use App\Model\LessonCategory;
use App\Model\Config;

class MainController extends Controller {
    
	public function index()
	{
	    $view = view('index');
            $view->pageTypes = PageType::orderBy('order', 'ASC')->get();
            $view->news = News::with('categories')
                            ->where('is_active','=',1)
                            ->orderBy('created_date')
                            ->take(11)
                            ->get();
            $view->lessons = DB::table('lesson')
                    ->join('teacher','lesson.teacher_id','=','teacher.id')
                    ->join('teacher_info','teacher.id','=','teacher_info.teacher_id')
                    ->join('lesson_channel','lesson.lesson_channel_id','=','lesson_channel.id')
                    ->join('lesson_category','lesson.lesson_category_id','=','lesson_category.id')
                    ->orderBy('created_date','desc')
                    ->select('lesson.lesson_name as name','lesson.lesson_content','lesson.id','lesson.created_date','teacher_info.firstname as teacher_name',
                            'teacher.id as teacher_id','lesson_channel.id as channel_id','lesson_channel.name as channel_name',
                            'lesson_category.id as category_id','lesson_category.name as category_name','teacher_info.portrait_image as image')
                    ->take(9)
                    ->get();
            $view->channels = LessonChannel::all();
            $view->config = Config::find(777);
            $view->categories = LessonCategory::all();
            
            return $view;
	}

}
