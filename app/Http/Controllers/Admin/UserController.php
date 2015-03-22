<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Redirect;
use App\Http\Middleware\CheckAuth;
class UserController extends Controller {

    public function __construct() {
        CheckAuth::check();
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $view = view('admin.user.index');
        $view->title = 'Системийн хэрэглэгчдийн жагсаалт';
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

    public function userList(Request $request) {
        $param = $request->all();
        return User::getUserList($param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $view = view('admin.user.create');
        $view->title = 'Системийн хэрэглэгч нэмэх';
        $view->js = array(
            'assets/plugins/jquery-validation/dist/jquery.validate.min.js',
            'assets/plugins/jquery-validation/dist/additional-methods.min.js'
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
        $isSaved = User::saveUser($param);

        if ($isSaved) {
            return Redirect::to('admin/user')->with('success', 'Амжилттай хадгаллаа!');
        } else {
            return Redirect::to('admin/user')->with('failed', 'Алдаа гарлаа!');
        }
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
        $user = User::find($id);
        $view = view('admin.user.edit', compact('user'));

        $view->title = 'Хэрэглэгчийн мэдээлэл засах';
        $view->js = array(
            'assets/plugins/jquery-validation/dist/jquery.validate.min.js',
            'assets/plugins/jquery-validation/dist/additional-methods.min.js'
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
        $param = $request->all();
        $isSaved = User::updateUser($id, $param);

        if ($isSaved) {
            return Redirect::to('admin/user')->with('success', 'Амжилттай хадгаллаа!');
        } else {
            return Redirect::to('admin/user')->with('failed', 'Алдаа гарлаа!');
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
            User::destroy($id);
        }

        echo json_encode($result);
    }

}
