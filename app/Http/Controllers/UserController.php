<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Users;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    function create(Request $request){
        foreach ($request->all() as $item){
            dump($item);
        }

        $rule = [
            'username' => 'required|min:4',
            'password' => 'required|confirmed|min:6'
        ];

        $validator = Validator::make($request->all(), $rule);
        dd($validator);
        if($validator->fails()){
            $error = $validator->errors();
            echo $error;
        }
        else{
            Users::create($request->all());
        }
    }

    public function index(Request $request)
    {
        $info = $request->all();
        $check_username=Users::where('username',$request->username)->first();

        if ($check_username){
            $check_password=Users::where('password',$request->password)->first();
            if($check_password){
                echo "done";
            }else{
                echo "sai mat khau";
            }
        }else{
            echo "sai tai khoan";
        }
    }
}
