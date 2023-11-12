<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testLoginPage(){
        $this->get("/login")->assertSeeText("Login");
    }

    public function testLoginPageForMember(){
        $this->withSession([
            "user" => "fajar",
        ])->get("/login")
          ->assertRedirect("/");
    }

    public function testLoginPageForUserAlreadyLogin(){
        $this->withSession([
            "user" => "fajar",
        ])->post("/login",[
            "username" => "fajar",
            "password" => "rahasia"
        ])
          ->assertRedirect("/");
    }

    public function testLoginSuccess(){
        $this->post(route("login"),[
            "username" => "fajar",
            "password" => "rahasia"
        ])->assertRedirect("/")
          ->assertSessionHas("user","fajar");
    }

    public function testLoginValidationError(){
        $this->post("/login",[])
             ->assertSeeText("User or Password is required");
    }

    public function testLoginFailed(){
        $this->post("/login",[
            "username" => "wrong",
            "password" => "wrong"
        ])->assertSeeText("User or Password is Wrong");
    }

    public function testLogout(){
        $this->withSession([
            "user" => "fajar"
        ])->post("/logout")
         ->assertRedirect("/")
         ->assertSessionMissing("user");
    }

    public function testLogoutGuest(){
        $this->post("/logout")
             ->assertRedirect("/login");
    }

}
