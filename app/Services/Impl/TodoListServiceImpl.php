<?php

namespace App\Services\Impl;

use App\Services\TodoListService;

class TodoListServiceImpl implements TodoListService{
    public function saveTodo(string $id, string $todo):void{
        if(!Session::exists("todolist")){
            Session::put("todolist", []);
        }

        Session::push("todolist",[
            "id" => $id,
            "todo" => $todo
        ]);
    }
}