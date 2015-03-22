<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Middleware\CheckAuth;
use App\Model\LessonCategory;
use App\Model\LessonChannel;
class LessonController extends Controller {

    public $categories = null;
    public $channels = null;
    
    public function __construct() {
        CheckAuth::checkTeacher();
        $this->categories = LessonCategory::all();
        $this->channels = LessonChannel::all();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $view = view('teacher.lesson.index');
        $view->title = 'Оруулсан хичээлүүдийн жагсаалт';

        return $view;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $view = view('teacher.lesson.create');
        $view->title = 'Хичээл оруулах';
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
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
