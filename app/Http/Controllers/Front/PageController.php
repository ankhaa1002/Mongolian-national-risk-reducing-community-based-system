<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Model\PageType;
use App\Model\Page;
use Illuminate\Http\Request;
use App\Model\News;
use App\Model\NewsCategory;
use App\Model\Config;
class PageController extends Controller {

    public $config = null;
    
    public function __construct() {
        $this->config = Config::find(777);
    }
    
    public function show($slug) {
        $view = view('front.page.show');
        $page = Page::where('slug', '=', $slug)->first();
        $view->page = $page;
        $view->title = $page->name;
        $view->pageTypes = PageType::orderBy('order', 'ASC')->get();
        $meta = array(
            'title' => $page->name,
            'url' => config('app.url') . '/pages/' . $page->slug,
            'image' => '',
            'description' => str_limit(strip_tags($page->content), 100),
            'site_name' => config('app.url')
        );
        $view->meta = $meta;
        $view->posts = News::orderBy('created_date','DESC')->where('is_active','=','1')->take(4)->get();
        $view->categories = NewsCategory::all();
        $view->config = $this->config;
        return $view;
    }

}
