<?php

namespace App\Services\Impl;

use App\Services\UserServices;

class UserServicesImpl implements UserServices{
    private array $users=[
        "fajar" => "rahasia"
    ];

    function login(string $username, string $password):bool{
        if(!isset($this->users[$username])){
            return false;
        }

        $correctPassword=$this->users[$username];

        return $password == $correctPassword;
    }
}