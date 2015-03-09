<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Page extends Model {

    public $timestamps = false;
    protected $table = 'page';

    public static function getAllPages($param) {
        $page = $param['page'];
        $rows = $param['rows'];
        $offset = ($page - 1) * $rows;
        $count = sizeof(Page::all());
        $type_id = $param['page_type_id'];
        $name = $param['name'];
        $list = DB::table('page')
                ->join('page_type', 'page.page_type_id', '=', 'page_type.id');
        if ($type_id) {
            $list->where('page.page_type_id', '=', $type_id);
        }

        if ($name) {
            $list->where('name', 'LIKE','%'.$name.'%');
        }
        
        $result = array(
            'rows' => $list
                ->skip($offset)
                ->take($rows)
                ->orderBy('created_date')
                ->select('page.id','slug','name','content','is_active','created_date','updated_date','page_type_id','page_type.page_type_name')
                ->get(),
            'total' => $count
        );

        return $result;
    }
    
    public static function savePage($param){
        $page = new Page();
        $page->name = $param['title'];
        $page->content = $param['content'];
        $page->created_date = $param['created_date'];
        $page->slug = str_slug($param['title']);
        $page->is_active = $param['is_active'];
        $page->page_type_id = $param['pageTypeId'][0];
        $result = $page->save();
        return $result;
    }
    
    public static function updatePage($id,$param){
        $page = Page::find($id);
        $page->name = $param['title'];
        $page->content = $param['content'];
        $page->slug = str_slug($param['title']);
        $page->created_date = $param['created_date'];
        $page->is_active = $param['is_active'];
        $page->page_type_id = $param['pageTypeId'][0];
        $result = $page->save();
        return $result;
    }

}
