<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TodoListService;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TodoListController extends Controller
{
    private TodoListService $todoListService;

    public function __construct(TodoListService $todoListService){
        $this->todoListService=$todoListService;
    }

    public function todoList(Request $request){
        $todoList=$this->todoListService->getTodoList();
        return response()->view("todolist.todolist",[
            "title" => "Todo List",
            "todolist" => $todoList
        ]);
    }

    public function addTodo(Request $request){
        $todo=$request->input("todo");

        if(empty($todo)){
            $todolist=$this->todoListService->getTodoList();
            return response()->view("todolist.todolist",[
                "title" => "Todolist",
                "todolist" => $todolist,
                "error" => "Todo is required"
            ]);
        }

        $this->todoListService->saveTodo(uniqid(), $todo);
 
        return redirect()->action([TodoListController::class, "todoList"]);
    }

    public function removeTodo(Request $request, string $todoId):RedirectResponse{
        $this->todoListService->removeTodo($todoId);
        return redirect()->action([TodoListController::class,'todoList']);
    }
}
