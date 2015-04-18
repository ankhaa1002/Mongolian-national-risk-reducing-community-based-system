<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class ReportController extends Controller {

    public function lessonByCategoryReport() {
        $result = DB::select(DB::raw("SELECT DISTINCT b.name label,(SELECT count(*) FROM lesson WHERE lesson.lesson_category_id = b.id) data 
                                        FROM lesson a
                                        INNER JOIN lesson_category b 
                                        ON a.lesson_category_id = b.id"));

        echo json_encode($result);
    }

    public function lessonByChannelReport() {
        $result = DB::select(DB::raw("SELECT DISTINCT b.name label,(SELECT count(*) FROM lesson WHERE lesson.lesson_channel_id = b.id) data FROM lesson a
                                        INNER JOIN lesson_channel b 
                                        ON a.lesson_channel_id = b.id"));

        echo json_encode($result);
    }

}
