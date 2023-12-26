<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoListControllerTest extends Controller
{
    public function testTodoList(){
        $this->withSession(
            [
                "user" => "fajar",
                "todolist" => [
                    "id" => "1",
                    "todo" => "Makan"
                ]
            ]
        )->get("/todolist")
         ->assertSeeText("1")
         ->assertSeeText("Makan");
         
    }

    public function testtAddTodoFailed(){
        $this->withSession([
            "user" => "fajar"
        ])->post("/todolist", [])
          ->assertSeeText("Todo is required");
    }

    public function testtAddTodoSuccess(){
        $this->withSession([
            "user" => "fajar"
        ])->post("/todolist", [
            "todo" => "Makan"
        ])
          ->assertSeeText("Todo is required");
    }
    
}
