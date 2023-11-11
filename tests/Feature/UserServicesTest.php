<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\UserServices;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserServicesTest extends TestCase
{
    private UserServices $userServices;

    protected function setUp():void{
        parent::setUp();

        $this->userServices = $this->app->make(UserServices::class);
    }

    public function testLoginSuccess(){
        self::assertTrue($this->userServices->login("fajar","rahasia"));
    }

    public function testLoginWrong(){
        self::assertFalse($this->userServices->login("fajar","entong"));
    }
}
