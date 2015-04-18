<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PageType;
use App\Model\News;
use App\Model\NewsCategory;
use App\Model\Config;
class NewsController extends Controller {

    public $pageTypes = null;
    public $posts = null;
    public $categories = null;
    public $config = null;
    
    public function __construct() {
        $this->pageTypes = PageType::orderBy('order', 'ASC')->get();
        $this->posts = News::orderBy('created_date','DESC')->where('is_active','=','1')->take(4)->get();
        $this->categories = NewsCategory::all();
        $this->config = Config::find(777);
    }

    public function index() {
        $view = view('front.news.index');
        $view->news = News::where('is_active','=','1')->paginate($this->config->blog_per_page);
        $view->news->setPath('');
        $view->title = 'Мэдээ мэдээллийн жагсаалт';
        $view->pageTypes = $this->pageTypes;
        $view->posts = $this->posts;
        $view->categories = $this->categories;
        $view->config = $this->config;
        return $view;
    }

    public function show($id) {
        $news = News::find($id);
        $view = view('front.news.show');
        $view->title = $news->title;
        $view->pageTypes = $this->pageTypes;
        $view->news = $news;
        $view->posts = $this->posts;
        $view->categories = $this->categories;
        $meta = array(
            'title' => $news->title,
            'url' => config('app.url').'/news/'.$news->id,
            'image' => isset($news->featured_image) ? asset($news->featured_image) : '',
            'description' => str_limit(strip_tags($news->content),100),
            'site_name' => config('app.url')
        );
        $view->meta = $meta;
        $view->config = $this->config;
        
        return $view;
    }

}
