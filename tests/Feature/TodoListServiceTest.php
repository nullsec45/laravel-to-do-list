<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\TodoListService;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TodoListServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
  private TodoListService $todoListService;

  public function setUp():void{
        parent::setUp();

        $this->todoListService=$this->app->make(TodoListService::class);
  }

  public function testTodoListNotNull(){
    self::assertNotNull($this->todoListService);
  }

  public function testSaveTodo(){
      $this->todoListService->saveTodo("1","Makan");

      $todolist=Session::get("todolist");
      foreach($todolist as $value){
          self::assertEquals("1", $value["id"]);
          self::assertEquals("Makan", $value["todo"]);
      }
  }

  public function testGetTodoListEmpty(){
    self::assertEquals([], $this->todoListService->getTodoList());
  }

  public function testGetTodoListNotEmpty(){
    $expected=[
      [
        "id" => "1",
        "todo" => "Makan"
      ]
    ];

    $this->todoListService->saveTodo("1","Makan");  
    
    self::assertEquals($expected, $this->todoListService->getTodoList());
  }

  public function testRemoveTodo(){
    $this->todoListService->saveTodo("1","Makan");  
    $this->todoListService->saveTodo("2","Minum");  
    self::assertEquals(2, sizeof($this->todoListService->getTodoList()));
    
    $this->todoListService->removeTodo("3");
    self::assertEquals(2, sizeof($this->todoListService->getTodoList()));

    $this->todoListService->removeTodo("1");
    self::assertEquals(1, sizeof($this->todoListService->getTodoList()));
  }
}
