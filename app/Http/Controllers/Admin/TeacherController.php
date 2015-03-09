<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\TeacherInfo;
use App\Model\Aimag;
use App\Model\District;
use App\Http\Middleware\CheckAuth;
use App\Model\Gender;
use App\Model\Teacher;
use Illuminate\Support\Facades\Redirect;

class TeacherController extends Controller {

    public $aimags = null;
    public $districts = null;
    public $genders = null;
    public function __construct() {
        CheckAuth::check();
        $this->aimags = Aimag::all();
        $this->districts = District::all();
        $this->genders = Gender::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $view = view('admin.teacher.index');
        $view->aimags = $this->aimags;
        $view->districts = $this->districts;
        $view->js = array(
            'assets/plugins/jquery-easyui/jquery.easyui.min.js',
            'assets/plugins/jquery-easyui/jquery.datagrid.js',
            'assets/plugins/jquery-easyui/locale/easyui-lang-mn.js'
        );

        $view->css = array(
            'assets/plugins/jquery-easyui/themes/metro/datagrid.css',
            'assets/plugins/jquery-easyui/themes/metro/easyui.css'
        );
        $view->title = 'Багш нарын жагсаалт';
        return $view;
    }

    public function getTeacherList(Request $request) {
        $param = array(
            'aimag_id' => $request->input('aimag_id'),
            'district_id' => $request->input('district_id'),
            'firstname' => $request->input('firstname'),
            'lastname' => $request->input('lastname'),
            'page' => $request->input('page'),
            'rows' => $request->input('rows')
        );
        $list = TeacherInfo::getAllTeacherInfo($param);
        echo json_encode($list);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $view = view('admin.teacher.create');
        $view->title = 'Багш нэмэх';
        $view->aimags = $this->aimags;
        $view->districts = $this->districts;
        $view->genders = $this->genders;
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
        $param = $request->all();
        $imgUrl = null;
        if($request->file('portrait_image') != null){
            $imgUrl = $this->saveImage($request->file('portrait_image'));
        }
        
        $param['portrait_url'] = $imgUrl;
        $isSaved = Teacher::saveTeacher($param);
        
        if ($isSaved) {
            return Redirect::to('admin/teacher')->with('success', 'Амжилттай хадгаллаа!');
        } else {
            return Redirect::to('admin/teacher')->with('failed', 'Алдаа гарлаа!');
        }
        
    }
    
    public function saveImage($file) {
        $imgUrl = "";
        $prenumber = rand(9999999, 99999999999999);
        $number = rand(9999999, 99999999999999);
        $filePath = 'assets/img/profile/teacher';
        $fileName = $prenumber . '_' . $number . '.' . $file->getClientOriginalExtension();
        $file->move($filePath, $fileName);
        $imgUrl = $filePath . '/' . $fileName;

        return $imgUrl;
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
