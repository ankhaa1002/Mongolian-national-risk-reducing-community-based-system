<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\TeacherInfo;
use App\Model\Address;
use Illuminate\Support\Facades\Hash;
class Teacher extends Model {

    public $timestamps = false;
    protected $table = 'teacher';

    public function teacherInfo() {
        return $this->hasOne('App\Model\TeacherInfo');
    }

    public static function saveTeacher($param) {
        $teacher = new Teacher();
        $teacher->username = $param['username'];
        $teacher->password = Hash::make($param['password']);
        $teacher->save();

        $teacherInfo = new TeacherInfo();
        $teacherInfo->firstname = $param['firstname'];
        $teacherInfo->lastname = $param['lastname'];
        $teacherInfo->birthdate = $param['birthdate'];
        $teacherInfo->gender_id = $param['gender'];
        $teacherInfo->company_name = $param['company_name'];
        $teacherInfo->position = $param['position'];
        $teacherInfo->phone = $param['phone1'];
        $teacherInfo->phone2 = isset($param['phone2']) ? $param['phone2'] : null;
        $teacherInfo->email = isset($param['email']) ? $param['email'] : null;
        $teacherInfo->portrait_image = $param['portrait_url'];
        $teacherInfo->profession = $param['profession'];
        $teacherInfo->teacher_id = $teacher->id;
        $teacherInfo->save();

        $address = new Address();
        $address->aimag_id = $param['aimag'];
        $address->district_id = isset($param['district']) ? $param['district'] : null;
        $address->address_detail = isset($param['address']) ? $param['address'] : null;
        $address->teacher_info_id = $teacherInfo->id;

        $result = $address->save();

        return $result;
    }

    public static function updateTeacher($id, $param) {
        $teacher = Teacher::find($id);
        $teacher->username = $param['username'];
        if ($param['password'] != "") {
            $teacher->password = Hash::make($param['password']);
        }
        
        $teacher->teacherInfo->firstname = $param['firstname'];
        $teacher->teacherInfo->lastname = $param['lastname'];
        $teacher->teacherInfo->birthdate = $param['birthdate'];
        $teacher->teacherInfo->gender_id = $param['gender'];
        $teacher->teacherInfo->company_name = $param['company_name'];
        $teacher->teacherInfo->position = $param['position'];
        $teacher->teacherInfo->phone = $param['phone1'];
        if ($param['phone2'] != "") {
            $teacher->teacherInfo->phone2 = $param['phone2'];
        }
        if ($param['email'] != "") {
            $teacher->teacherInfo->email = $param['email'];
        }
        if ($param['portrait_url'] != null) {
            $teacher->teacherInfo->portrait_image = $param['portrait_url'];
        }
        $teacher->teacherInfo->profession = $param['profession'];
        $teacher->teacherInfo->teacher_id = $teacher->id;
        
        $teacher->teacherInfo->address->aimag_id = $param['aimag'];
        if (isset($param['district'])) {
            $teacher->teacherInfo->address->district_id = $param['district'];
        }
        if ($param['address']!= "") {
            $teacher->teacherInfo->address->address_detail = $param['address'] ;
        }
        
        $result = $teacher->push();
        
        return $result;
    }

}
