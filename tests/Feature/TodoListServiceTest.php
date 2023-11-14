<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\TodoListService;
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
}
