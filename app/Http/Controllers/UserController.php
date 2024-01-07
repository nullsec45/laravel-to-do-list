<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\UserServices;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    private UserServices $userServices;

    public function __construct(UserServices $userServices){
        $this->userServices=$userServices;
        $this->authLogger=Log::channel("auth");
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

        if(empty($username) || empty($password)){
            $this->authLogger->warning("User or Password is required");

            return response()->view("user.login",[
                "title" => "Login",
                "error" => "User or Password is required"
            ]);
        }

        if($this->userServices->login($username, $password)){
            $this->authLogger->info("User ".$username." login to system");

            $request->session()->put("user", $username);
            return redirect("/");
        }

        $this->authLogger->warning("User or Password is Wrong");
        
        return response()->view("user.login",[
            "title" => "Login",
            "error" => "User or Password is Wrong"
        ]);
    }

    public function doLogout(Request $request){
        $this->authLogger->info("User ".$request->session()->get('user')." logout to system");

        $request->session()->forget("user");
        return redirect("/login");
    }
}
