<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\UserServices;

class UserController extends Controller
{
    private UserServices $userServices;

    public function __construct(UserServices $userServices){
        $this->userServices=$userServices;
    }

    public function login():Response{
        $data=[
            "title" => "Login"
        ];
       return response()->view("user.login", $data);
    }

    public function doLogin(Request $request){
        $username=$request->input("username");
        $password=$request->input("password");
        // dd($password);

        if(empty($username) || empty($password)){
            return response()->view("user.login",[
                "title" => "Login",
                "error" => "User or Password is required"
            ]);
        }

        if($this->userServices->login($username, $password)){
            $request->session()->put("user", $username);
            return redirect("/");
        }

        return response()->view("user.login",[
            "title" => "Login",
            "error" => "User or Password is Wrong"
        ]);
    }

    public function doLogout(Request $request){
        $request->session()->forget("user");
        return redirect("/login");
    }
}
