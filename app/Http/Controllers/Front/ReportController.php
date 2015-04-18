<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\PageType;
use App\Model\Config;

class ReportController extends Controller {

    public $config = null;

    public function __construct() {
        $this->config = Config::find(777);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $view = view('front.statistics.index');
        $view->title = 'Хичээлийн статистик мэдээлэл';
        $view->pageTypes = PageType::orderBy('order', 'ASC')->get();
        $view->config = $this->config;
        return $view;
    }

}
