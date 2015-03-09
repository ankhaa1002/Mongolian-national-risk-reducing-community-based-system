<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PageType;
use App\Http\Middleware\CheckAuth;
use App\Model\Page;
use Illuminate\Support\Facades\Redirect;

class PageController extends Controller {

    public $pageTypes = null;

    public function __construct() {
        CheckAuth::check();
        $this->pageTypes = PageType::all();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $view = view('admin.page.index');
        $view->title = 'Хуудасны жагсаалт';
        $view->pageTypes = $this->pageTypes;
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

    public function getPageList(Request $request) {
        $param = array(
            'page' => $request->input('page'),
            'rows' => $request->input('rows'),
            'name' => $request->input('name'),
            'page_type_id' => $request->input('page_type_id')
        );
        $data = Page::getAllPages($param);
        echo json_encode($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $view = view('admin.page.create');
        $view->pageTypes = $this->pageTypes;
        $view->title = 'Хуудас үүсгэх';
        $view->js = array(
            'assets/plugins/ckeditor/ckeditor.js',
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
        $param = array(
            'title' => $request->input('title'),
            'content' => $request->input('editor1'),
            'pageTypeId' => $request->input('pageTypes'),
            'created_date' => $request->input('created_date'),
            'is_active' => $request->input('is_active') == "on" ? 1 : 0
        );

        $isSaved = Page::savePage($param);
        if ($isSaved) {
            return Redirect::to('admin/page')->with('success', 'Хуудас амжилттай үүслээ!');
        } else {
            return Redirect::to('admin/page')->with('failed', 'Алдаа гарлаа!');
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
        $page = Page::find($id);
        $i = 0;
        $pageTypes = $this->pageTypes;
        $selectedType = $page->page_type_id;
        foreach ($pageTypes as $type) {
            if ($type['id'] == $selectedType) {
                $pageTypes[$i]['selected'] = 'selected';
            }
            $i++;
        }

        $view = view('admin.page.edit', compact('page'));
        $view->title = 'Хуудас засах';
        $view->pageTypes = $pageTypes;
        $view->js = array(
            'assets/plugins/ckeditor/ckeditor.js',
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
    public function update($id,Request $request) {
        $params = array(
            'title' => $request->input('title'),
            'pageTypeId' => $request->input('pageTypes'),
            'content' => $request->input('editor1'),
            'created_date' => $request->input('created_date'),
            'is_active' => $request->input('is_active') == "on" ? 1 : 0
        );

        $isUpdated = Page::updatePage($id, $params);

        if ($isUpdated) {
            return Redirect::to('admin/page')->with('success', 'Хуудас амжилттай засварлагдлаа!');
        } else {
            return Redirect::to('admin/page')->with('failed', 'Алдаа гарлаа!');
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
        foreach($request->input('ids') as $id){
            Page::destroy($id);
        }
        
        echo json_encode($result);
    }

}
