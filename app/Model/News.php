<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Illuminate\Support\Facades\Session;

class News extends Model {

    protected $table = 'news';
    public $timestamps = false;

    public function categories() {
        return $this->belongsToMany('App\Model\NewsCategory', 'news_category_map', 'news_id', 'category_id');
    }

    public static function getAllNews($param) {
        $page = $param['page'];
        $rows = $param['rows'];
        $title = $param['title'];
        $date = $param['date'];
        $offset = ($page - 1) * $rows;
        $count = News::all()->count();

            $temp = News::with('categories')
                    ->where('title', 'like', '%' . $title . '%')
                    ->skip($offset)
                    ->take($rows);

        if ($date != null) {
            $semp = $temp
                    ->where('created_date', '=', $date)
                    ->get();
            $news = $semp;
        } else {
            $news = $temp->get();
        }

        $counter = 0;
        foreach ($news as $data) {
            $user = User::find($data['created_user']);
            unset($user['password']);
            unset($user['id']);
            unset($user['is_active']);
            $news[$counter]['username'] = $user['user_name'];
            $counter++;
        }

        $result = array();
        $result['total'] = $count;
        $result['rows'] = $news;

        return $result;
    }
    
    public static function saveNews($param){
        $news = new News();
        $news->title = $param['title'];
        $news->content = $param['content'];
        $news->created_date = $param['created_date'];
        $news->featured_image = $param['featured_image'];
        $news->created_user = Session::get('user')->id;
        $result = $news->save();
        $news->categories()->sync($param['categories']);
        return $result;
    }

}
