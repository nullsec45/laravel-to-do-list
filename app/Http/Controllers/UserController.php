<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    public function login():Response{
        $data=[
            "title" => "Login"
        ];
       return response()->view("user.login", $data);
    }

    public function doLogin(){

    }

    public function doLogout(){
        
    }
}
