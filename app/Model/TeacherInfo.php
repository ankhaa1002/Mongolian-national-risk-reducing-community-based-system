<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TeacherInfo extends Model {

    public $timestamps = false;
    protected $table = 'teacher_info';

    public function address() {
        return $this->hasOne('App\Model\Address');
    }

    public static function getAllTeacherInfo($param) {
        $page = $param['page'];
        $rows = $param['rows'];
        $count = sizeof(Teacher::all());
        $firstname = $param['firstname'];
        $lastname = $param['lastname'];
        $aimagId = $param['aimag_id'];
        $districtId = $param['district_id'];
        $offset = ($page - 1) * $rows;
        $list = DB::table('teacher_info')
                ->join('gender', 'teacher_info.gender_id', '=', 'gender.id')
                ->join('address', 'teacher_info.id', '=', 'address.teacher_info_id')
                ->join('aimag', 'address.aimag_id', '=', 'aimag.id')
                ->leftJoin('district', 'address.district_id', '=', 'district.id')
                ->select('teacher_info.firstname', 'teacher_info.lastname', 'aimag.name as aimag_name', 'teacher_info.position', 
                        'teacher_info.birthdate', 'teacher_info.portrait_image', 'teacher_info.email', 'teacher_info.profession', 
                        'district.name as district_name','teacher_info.teacher_id as id');

        if ($param['firstname']) {
            $list->where('teacher_info.firstname', 'LIKE','%'. $firstname .'%');
        }
        
        if ($param['lastname']) {
            $list->where('teacher_info.lastname', 'LIKE','%'. $lastname .'%');
        }
        
        if ($param['aimag_id']) {
            $list->where('address.aimag_id', '=', $aimagId);
        }
        if ($param['district_id']) {
            $list->where('address.district_id', '=', $districtId);
        }
        
        $result = array(
            'total' => $count,
            'rows' => $list->skip($offset)->take($rows)->get()
        );

        return $result;
    }

}
