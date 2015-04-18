<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Model\Teacher;
use App\Model\TeacherInfo;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\Model\Lesson;
use App\Model\LessonLog;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller {

    public function showLogin() {
        if (!Session::has('teacher')) {
            return view('teacher.login');
        } else {
            return Redirect::to('adminTeacher');
        }
    }

    public function index() {
        if (Session::has('teacher')) {
            $view = view('teacher.index');
            $view->title = 'Багшийн удирдлагын хэсэг';
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
            $view->lessonCount = Lesson::where('teacher_id', '=', Session::get('teacher')->id)->count();
            $view->lessonLogs = LessonLog::where('lesson_log.teacher_id', '=', Session::get('teacher')->id)
                    ->join('lesson', 'lesson_id', '=', 'lesson.id')
                    ->orderBy('lesson_log.created_date', 'desc')
                    ->get();
            $view->aimag = Teacher::find(Session::get('teacher')->id)->teacherInfo->address->aimag->name;
            $district = Teacher::find(Session::get('teacher')->id)->teacherInfo->address->aimag->districts;
            $view->district = isset($district[0]) ? $district[0]->name : null;
            return $view;
        } else {
            return Redirect::to('teacherLogin');
        }
    }

    public function categoryStat() {
        $result = DB::select(DB::raw("SELECT DISTINCT b.name label,(SELECT count(*) FROM lesson WHERE lesson.lesson_category_id = b.id) data 
                                        FROM lesson a
                                        INNER JOIN lesson_category b 
                                        ON a.lesson_category_id = b.id
                                        WHERE a.teacher_id = :teacherId"), array(
                    'teacherId' => Session::get('teacher')->id,
        ));
        
        echo json_encode($result);
    }
    
    public function channelStat() {
        $result = DB::select(DB::raw("SELECT DISTINCT b.name label,(SELECT count(*) FROM lesson WHERE lesson.lesson_channel_id = b.id) data FROM lesson a
                                        INNER JOIN lesson_channel b 
                                        ON a.lesson_channel_id = b.id
                                        WHERE a.teacher_id = :teacherId"), array(
                                                            'teacherId' => Session::get('teacher')->id,
                                                ));
        
        echo json_encode($result);
    }
    
    public function checkTeacher(Request $request) {
        $teachers = Teacher::all();
        $username = $request->input('username');
        $password = $request->input('password');
        foreach ($teachers as $teacher) {
            if ($teacher['username'] == $username && Hash::check($password, $teacher['password'])) {
                $avatar = TeacherInfo::where('teacher_id','=',$teacher['id'])->first();
                Session::put('teacher', $teacher);
                Session::put('avatar',$avatar);
                return Redirect::to('adminTeacher')->with('message', 'Тавтай морил!');
            }
        }

        return Redirect::to('teacherLogin')->with('fail', 'Нэр эсвэл нууц үг буруу байна!');
    }

    public function logOut() {
        Session::forget('teacher');
        return Redirect::to('teacherLogin')->with('success', 'Амжилттай удирдлагаас гарлаа!');
    }

}
