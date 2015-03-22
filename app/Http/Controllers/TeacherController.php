<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Model\Teacher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

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
                'assets/plugins/fullcalendar/fullcalendar/fullcalendar.min.js'
            );
            return $view;
        } else {
            return Redirect::to('teacherLogin');
        }
    }

    public function checkTeacher(Request $request) {
        $teachers = Teacher::all();
        $username = $request->input('username');
        $password = $request->input('password');
        foreach ($teachers as $teacher) {
            if ($teacher['username'] == $username && Hash::check($password, $teacher['password'])) {
                Session::put('teacher', $teacher);
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
