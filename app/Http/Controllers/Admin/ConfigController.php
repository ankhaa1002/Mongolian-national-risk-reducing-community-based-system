<?php namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Model\Config as Configuration;

class ConfigController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $config = Configuration::find(777);
	    $view = view('admin.config.index');
            $view->title = 'Тохиргоо';
            $view->config = $config;
            return $view;
	}
        
	public function store(Request $request)
	{
            $config = Configuration::find(777);
	    $param = $request->all();
            
            $config->site_title = $param['siteTitle'];
            $config->site_description = $param['siteDescription'];
            $config->address = $param['address'];
            $config->website = $param['website'];
            $config->phone = $param['phone'];
            $config->facebook = $param['facebookLink'];
            $config->twitter = $param['twitterLink'];
            $config->blog_per_page = $param['blogPerPage'];
            $config->lesson_per_page = $param['lessonPerPage'];
            $config->save();
            
            return Redirect::to('admin/config')->with('success', 'Тохиргоо амжилттай хадгалагдлаа!');
	}

}
