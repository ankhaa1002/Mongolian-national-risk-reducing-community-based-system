<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\LessonChannel;
use App\Http\Middleware\CheckAuth;
class LessonChannelController extends Controller {

    public function __construct() {
        CheckAuth::check();
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $view = view('admin.lessonChannel.index');
        $view->title = 'Хичээлийн сувгийн жагсаалт';
        $view->js = array(
            'assets/plugins/jquery-easyui/jquery.easyui.min.js',
            'assets/plugins/jquery-easyui/jquery.datagrid.js',
            'assets/plugins/jquery-easyui/locale/easyui-lang-mn.js',
            'assets/plugins/jquery-validation/dist/jquery.validate.min.js',
            'assets/plugins/jquery-validation/dist/additional-methods.min.js'
        );

        $view->css = array(
            'assets/plugins/jquery-easyui/themes/metro/datagrid.css',
            'assets/plugins/jquery-easyui/themes/metro/easyui.css'
        );
        return $view;
    }

    public function lessonChannelList(Request $request) {
        $param = array(
            'page' => $request->input('page'),
            'rows' => $request->input('rows'),
            'name' => $request->input('name')
        );

        $list = LessonChannel::getLessonChannelList($param);

        echo json_encode($list);
    }

    public function addLessonChannel() {
        $response = array(
            'Html' => view('admin.lessonChannel.create')->render(),
            'title' => 'Суваг нэмэх',
            'save_btn' => 'Хадгалах',
            'close_btn' => 'Хаах'
        );
        echo json_encode($response);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
        $param = $request->all();
        $lessonChannel = new LessonChannel();
        $lessonChannel->name = $param['name'];
        try {
            $result = $lessonChannel->save();
            if ($result) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Амжилттай хадгаллаа!',
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Алдаа!'
                );
            }
        } catch (\Exception $e) {
            $response = array(
                'status' => 'error',
                'message' => 'Сувгийн нэр давхардаж байна!'
            );
        }


        echo json_encode($response);
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
        $view = view('admin.lessonChannel.edit');
        $view->category = LessonChannel::find($id);
        $response = array(
            'Html' => $view->render(),
            'title' => 'Суваг засах',
            'save_btn' => 'Хадгалах',
            'close_btn' => 'Хаах'
        );
        echo json_encode($response);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, Request $request) {
        $param = $request->all();
        $category = LessonChannel::find($id);
        $category->name = $param['name'];
        try {
            $result = $category->update();
            if ($result) {
                $response = array(
                    'status' => 'success',
                    'message' => 'Амжилттай хадгаллаа!',
                );
            } else {
                $response = array(
                    'status' => 'error',
                    'message' => 'Алдаа!'
                );
            }
        } catch (\Exception $e) {
            $response = array(
                'status' => 'error',
                'message' => 'Ангилалын нэр давхардаж байна!'
            );
        }


        echo json_encode($response);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id, Request $request) {
        $result = true;
        foreach ($request->input('ids') as $id) {
            LessonChannel::destroy($id);
        }

        echo json_encode($result);
    }

}
