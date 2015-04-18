<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Model\News;
use App\Model\Page;
use App\Model\Teacher;
use App\Model\Lesson;
use Illuminate\Support\Facades\DB;
class AdminController extends Controller {

    public function showLogin() {
        if (!Session::has('user')) {
            return view('admin.login');
        } else {
            return Redirect::to('admin');
        }
    }

    public function index() {
        if (Session::has('user')) {
            $view = view('admin.index');
            $view->title = 'Удирдлагын хэсэг';
            $view->newsCount = News::all()->count();
            $view->pagesCount = Page::all()->count();
            $view->teachersCount = Teacher::all()->count();
            $view->lessonsCount = Lesson::all()->count();
            $view->lessonLogs = DB::table('lesson_log')
                    ->join('teacher','lesson_log.teacher_id','=','teacher.id')
                    ->join('teacher_info','teacher.id','=','teacher_info.teacher_id')
                    ->join('lesson', 'lesson_id', '=', 'lesson.id')
                    ->orderBy('lesson_log.created_date','desc')
                    ->get();
            $view->js = array(
                'assets/plugins/jqvmap/jqvmap/jquery.vmap.js',
                'assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.russia.js',
                'assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.world.js',
                'assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.europe.js',
                'assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.germany.js',
                'assets/plugins/jqvmap/jqvmap/maps/jquery.vmap.usa.js',
                'assets/plugins/jqvmap/jqvmap/data/jquery.vmap.sampledata.js',
                'assets/plugins/flot/jquery.flot.js',
                'assets/plugins/flot/jquery.flot.resize.js',
                'assets/plugins/jquery.pulsate.min.js',
                'assets/plugins/gritter/js/jquery.gritter.js',
                'assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js',
                'assets/plugins/flot/jquery.flot.pie.js'
            );
            return $view;
        } else {
            return Redirect::to('auth');
        }
    }

    public function checkUser(Request $request) {
        $users = User::getAllUser();
        $username = $request->input('username');
        $password = $request->input('password');
        foreach ($users as $user) {
            if ($user['user_name'] == $username && Hash::check($password, $user['password'])) {
                if ($user->is_active == 0) {
                    return Redirect::to('auth')->with('fail', 'Та нэвтрэх эрхгүй байна!');
                }
                Session::put('user', $user);
                return Redirect::to('admin')->with('message', 'Тавтай морил!');
            }
        }

        return Redirect::to('auth')->with('fail', 'Нэр эсвэл нууц үг буруу байна!');
    }

    public function logOut() {
        Session::forget('user');
        return Redirect::to('auth')->with('success', 'Амжилттай удирдлагаас гарлаа!');
    }

}
