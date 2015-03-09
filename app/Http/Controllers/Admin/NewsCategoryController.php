<?php

namespace App\Http\Controllers\admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\NewsCategory;
use Illuminate\Http\Request;

class NewsCategoryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $view = view('admin.newsCategory.index');
        $view->title = 'Мэдээний ангилал';
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

    public function getCategoryList(Request $request) {
        $name = $request->input('name');
        $param = array(
            'page' => $request->input('page'),
            'rows' => $request->input('rows')
        );
        $categories = NewsCategory::getAllCategory($name,$param);
        return $categories;
    }

    public function addCategory() {
        $response = array(
            'Html' => view('admin.newsCategory.create')->render(),
            'title' => 'Ангилал нэмэх',
            'save_btn' => 'Хадгалах',
            'close_btn' => 'Хаах'
        );
        echo json_encode($response);
    }

    public function editCategory() {
        $response = array(
            'Html' => view('admin.newsCategory.edit')->render(),
            'title' => 'Ангилал засах',
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
        $category = new NewsCategory();
        $category->name = $param['name'];
        try {
            $result = $category->save();
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
        $view = view('admin.newsCategory.edit');
        $view->category = NewsCategory::find($id);
        $response = array(
            'Html' => $view->render(),
            'title' => 'Ангилал засах',
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
        $category = NewsCategory::find($id);
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
    public function destroy($id,Request $request) {
        $result = true;
        foreach ($request->input('ids') as $id) {
            NewsCategory::destroy($id);
        }

        echo json_encode($result);
    }

}
