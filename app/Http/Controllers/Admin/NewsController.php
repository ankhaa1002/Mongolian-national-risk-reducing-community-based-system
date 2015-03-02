<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\NewsCategory;
use App\Model\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Middleware\CheckAuth;
class NewsController extends Controller {

    public $categories = null;

    
    public function __construct() {
        CheckAuth::check();
        $this->categories = NewsCategory::getAllCategory();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $view = view('admin.news.index');
        $view->title = 'Мэдээллийн жагсаалт';
        $view->categories = $this->categories;
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

    public function newsList(Request $request) {
        $param = array(
            'title' => $request->input('title'),
            'date' => $request->input('date'),
            'page' => $request->input('page'),
            'rows' => $request->input('rows'),
            'category' => $request->input('category')
        );
        return News::getAllNews($param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $view = view('admin.news.create');
        $view->categories = $this->categories;
        $view->title = 'Мэдээлэл нэмэх';
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

    public function upload(Request $request) {
        $message = "";
        $fileUrl = "";
        $funcNum = $_GET['CKEditorFuncNum'];
        $file = $request->file('upload');
        if ($file == null) {
            $message = "No file uploaded.";
        } else if ($file->getClientSize() == 0) {
            $message = "The file is of zero length.";
        } else if (($file->getClientOriginalExtension() != "jpg")
                AND ( $file->getClientOriginalExtension() != "jpeg")
                AND ( $file->getClientOriginalExtension() != "png")
                AND ( $file->getClientOriginalExtension() != "gif")) {
            $message = "The image must be in either JPG or PNG or GIF format. Please upload a JPG or PNG instead.";
        } else {
            $prenumber = rand(9999999, 99999999999999);
            $number = rand(9999999, 99999999999999);
            $fileName = $prenumber . '_' . $number . '.' . $file->getClientOriginalExtension();
            $filePath = 'assets/img/post';
            $file->move($filePath, $fileName);
            $fileUrl = asset('' . $filePath . '/' . $fileName);
            $message = "Successfully uploaded";
        }
        echo '<script type="text/javascript">window.parent.CKEDITOR.tools.callFunction(' . $funcNum . ', "' . $fileUrl . '", "' . $message . '");</script>';
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
        $imgUrl = null;
        if ($request->file('featured_image') != null) {
            $file = $request->file('featured_image');
            $imgUrl = $this->saveImage($file);
        }
        $param = array(
            'title' => $request->input('title'),
            'content' => $request->input('editor1'),
            'categories' => $request->input('categories'),
            'created_date' => $request->input('created_date'),
            'featured_image' => $imgUrl
        );

        $isSaved = News::saveNews($param);
        if ($isSaved) {
            return Redirect::to('admin/news')->with('success', 'Мэдээ амжилттай нийтлэгдлээ!');
        } else {
            return Redirect::to('admin/news')->with('failed', 'Алдаа гарлаа!');
        }
    }

    public function saveImage($file) {
        $imgUrl = "";
        $prenumber = rand(9999999, 99999999999999);
        $number = rand(9999999, 99999999999999);
        $filePath = 'assets/img/post/featured_image';
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {

        $i = 0;
        $categories = $this->categories;
        $selectedCategories = News::getNews($id)->categories()->get();
        foreach ($categories as $cat) {
            foreach ($selectedCategories as $sCat) {
                if ($cat['id'] == $sCat['id']) {
                    $categories[$i]['selected'] = 'selected';
                }
            }
            $i++;
        }
        $news = News::getNews($id);
        $view = view('admin.news.edit', compact('news'));
        $view->title = 'Мэдээлэл засах';
        $view->categories = $categories;
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
        $imgUrl = null;
        $news = News::find($id);
        if ($request->file('featured_image') != null) {
            $file = $request->file('featured_image');
            $imgUrl = $this->saveImage($file);
        }
        $params = array(
            'title' => $request->input('title'),
            'categories' =>$request->input('categories'),
            'content' => $request->input('editor1'),
            'created_date' => $request->input('created_date'),
            'featured_image' => $imgUrl == null ? $news->featured_image : $imgUrl
        );
        
        $isSaved = News::updateNews($params, $id);
        
        if ($isSaved) {
            return Redirect::to('admin/news')->with('success', 'Мэдээ амжилттай засварлагдлаа!');
        } else {
            return Redirect::to('admin/news')->with('failed', 'Алдаа гарлаа!');
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
            News::destroy($id);
        }
        
        echo json_encode($result);
    }

}
