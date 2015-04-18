<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Middleware\CheckAuth;
use App\Model\LessonCategory;
use App\Model\LessonChannel;
use Illuminate\Support\Facades\Session;
use App\Model\TeacherInfo;
use App\Model\Lesson;
use Illuminate\Support\Facades\Redirect;
use App\Model\Teacher;

class LessonController extends Controller {

    public $categories = null;
    public $channels = null;

    public function __construct() {
        CheckAuth::check();
        $this->categories = LessonCategory::all();
        $this->channels = LessonChannel::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $view = view('admin.lesson.index');
        $view->title = 'Багш нарын оруулсан хичээлүүдийн жагсаалт';
        $view->categories = $this->categories;
        $view->channels = $this->channels;
        $view->js = array(
            'assets/plugins/jquery-easyui/jquery.easyui.min.js',
            'assets/plugins/jquery-easyui/jquery.datagrid.js',
            'assets/plugins/jquery-easyui/locale/easyui-lang-mn.js'
        );

        $view->css = array(
            'assets/plugins/jquery-easyui/themes/metro/datagrid.css',
            'assets/plugins/jquery-easyui/themes/metro/easyui.css'
        );
        return $view;
    }

    public function allLessons(Request $request) {
        $params = $request->all();
        $result = Lesson::allLessons($params);

        return $result;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $view = view('admin.lesson.create');
        $view->title = 'Хичээл оруулах';
        $view->categories = $this->categories;
        $view->channels = $this->channels;
        $view->teachers = TeacherInfo::all();
        $view->js = array(
            'assets/plugins/ckeditor/ckeditor.js',
            'assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js',
            'assets/plugins/jquery-validation/dist/jquery.validate.min.js',
            'assets/plugins/jquery-validation/dist/additional-methods.min.js'
        );
        $view->css = array(
            'assets/plugins/bootstrap-fileupload/bootstrap-fileupload.css'
        );

        return $view;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
        $datas = $request->all();
        $videoUrl = null;
        $pptUrl = null;
        if ($request->file('video_lesson')) {
            $videoUrl = $this->saveFile($request->file('video_lesson'), 'video', $datas['teacher']);
        }
        if ($request->file('power_point_lesson')) {
            $pptUrl = $this->saveFile($request->file('power_point_lesson'), 'ppt', $datas['teacher']);
        }

        $params = array(
            'lesson_name' => $datas['title'],
            'created_date' => date('Y-m-d H:i:s'),
            'lesson_channel_id' => $datas['channel'],
            'lesson_category_id' => $datas['category'],
            'lesson_content' => $datas['editor1'],
            'video_url' => $videoUrl,
            'ppt_url' => $pptUrl,
            'teacher_id' => $datas['teacher']
        );

        $isSaved = Lesson::saveLesson($params);

        if ($isSaved) {
            return Redirect::to('admin/lesson')->with('success', 'Хичээл амжилттай нийтлэгдлээ!');
        } else {
            return Redirect::to('admin/lesson')->with('failed', 'Алдаа гарлаа!');
        }
    }

    public function saveFile($file, $type, $id) {
        $name = Teacher::find($id)->username;
        $fileUrl = "";
        $prenumber = rand(9999999, 99999999999999);
        $number = rand(9999999, 99999999999999);
        $teacherDirectory = 'assets/lib/lessons/' . $name;
        if (!file_exists($teacherDirectory)) {
            mkdir($teacherDirectory);
        }
        $fileName = $prenumber . '_' . $number . '.' . $file->getClientOriginalExtension();
        $file->move($teacherDirectory . '/' . $type, $fileName);
        $fileUrl = $teacherDirectory . '/' . $type . '/' . $fileName;

        return $fileUrl;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $lesson = Lesson::find($id);
        $view = view('admin.lesson.edit', compact('lesson'));
        $view->title = 'Хичээл засах';
        $view->categories = $this->categories;
        $view->channels = $this->channels;
        $view->js = array(
            'assets/plugins/ckeditor/ckeditor.js',
            'assets/plugins/bootstrap-fileupload/bootstrap-fileupload.js',
            'assets/plugins/jquery-validation/dist/jquery.validate.min.js',
            'assets/plugins/jquery-validation/dist/additional-methods.min.js'
        );
        $view->css = array(
            'assets/plugins/bootstrap-fileupload/bootstrap-fileupload.css'
        );

        return $view;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request) {
        $teacherId = Lesson::find($id)->teacher_id;
        $datas = $request->all();
        $videoUrl = null;
        $pptUrl = null;
        if ($request->file('video_lesson')) {
            $videoUrl = $this->saveFile($request->file('video_lesson'), 'video', $teacherId);
        }
        if ($request->file('power_point_lesson')) {
            $pptUrl = $this->saveFile($request->file('power_point_lesson'), 'ppt', $teacherId);
        }
        $params = array(
            'lesson_name' => $datas['title'],
            'updated_date' => date('Y-m-d H:i:s'),
            'lesson_channel_id' => $datas['channel'],
            'lesson_category_id' => $datas['category'],
            'lesson_content' => $datas['editor1'],
            'video_url' => $videoUrl,
            'ppt_url' => $pptUrl,
            'teacher_id' => $teacherId
        );

        $isSaved = Lesson::updateLesson($params, $id);

        if ($isSaved) {
            return Redirect::to('admin/lesson')->with('success', 'Хичээл амжилттай хадгалагдлаа!');
        } else {
            return Redirect::to('admin/lesson')->with('failed', 'Алдаа гарлаа!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id,Request $request) {
        $result = true;
        foreach ($request->input('ids') as $id) {
            Lesson::destroy($id);
        }

        echo json_encode($result);
    }

}
