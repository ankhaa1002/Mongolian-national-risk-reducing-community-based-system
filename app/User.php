<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model {

    protected $table = 'user';
    public $timestamps = false;

    public static function getAllUser() {
        return User::all();
    }

    public static function getUserList($param) {
        $username = isset($param['username']) ? $param['username'] : "";
        $count = sizeof(User::all());
        $page = $param['page'];
        $rows = $param['rows'];
        $offset = ($page - 1) * $rows;
        $userList = User::where('user_name', 'LIKE', '%' . $username . '%')
                ->skip($offset)
                ->take($rows)
                ->get();
        $result = array(
            'total' => $count,
            'rows' => $userList
        );
        return $result;
    }

    public static function saveUser($param) {
        $isActive = isset($param['is_active']) ? 1 : 0;
        $user = new User();
        $user->user_name = $param['username'];
        $user->password = Hash::make($param['password']);
        $user->is_active = $isActive;
        $user->email = $param['email'];
        $user->firstname = $param['firstName'];
        $user->lastname = $param['lastName'];
        $isSaved = $user->save();

        return $isSaved;
    }

    public static function updateUser($id, $param) {
        $isActive = isset($param['is_active']) ? 1 : 0;
        $user = User::find($id);
        $user->user_name = $param['username'];
        if (isset($param['password'])) {
            $user->password = Hash::make($param['password']);
        }
        $user->is_active = $isActive;
        $user->email = $param['email'];
        $user->firstname = $param['firstName'];
        $user->lastname = $param['lastName'];
        $isSaved = $user->save();

        return $isSaved;
    }

}
