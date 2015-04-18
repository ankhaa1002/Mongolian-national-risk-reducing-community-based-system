<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\NewsCategory;
use App\Model\News;
use Illuminate\Http\Request;
use App\Model\PageType;
use App\Model\Config;

class CategoryController extends Controller {

    public $config = null;
    
    public function __construct() {
        $this->config = Config::find(777);
    }
    
    public function show($id) {
        $category = NewsCategory::find($id);
        $view = view('front.category.show');
        $view->news = $category->news()->paginate($this->config->blog_per_page);
        $view->news->setPath('');
        $view->title = $category->name;
        $view->pageTypes = PageType::orderBy('order', 'ASC')->get();
        $view->posts = News::orderBy('created_date', 'DESC')->where('is_active', '=', '1')->take(4)->get();
        $view->categories = NewsCategory::all();
        $view->config = $this->config;
        return $view;
    }

}
