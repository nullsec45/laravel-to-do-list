<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodoListControllerTest extends TestCase
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
    
    public function testRemoveTodolist(){
        $this->withSession([
            "user" => "fajar",
            "todolist" => [
                [
                    "id" => "1",
                    "todo" => "Fajar"
                ],
                [
                    "id" => "2",
                    "todo" => "Fadhillah"
                ]
            ]
        ])->post("/todolist/1/delete")
          ->assertRedirect("/todolist");
    }
}
