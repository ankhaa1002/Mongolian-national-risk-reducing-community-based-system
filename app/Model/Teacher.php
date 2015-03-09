<?php namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\TeacherInfo;
use App\Model\Address;
class Teacher extends Model {

    public $timestamps = false;
    protected $table = 'teacher';
    
    public function teacherInfo()
    {
        return $this->hasOne('App\Model\TeacherInfo');
    }
    
    public static function saveTeacher($param){
        $teacher = new Teacher();
        $teacher->username = $param['username'];
        $teacher->password = $param['password'];
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

}
