<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\TodoListService;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TodoListController extends Controller
{
    private TodoListService $todoListService;

    public function __construct(TodoListService $todoListService){
        $this->todoListService=$todoListService;
        $this->authLogger=Log::channel("todos");
    }

    public function todoList(Request $request){
        $todoList=$this->todoListService->getTodoList();
        $this->authLogger->info($request->session()->get('user')." get todos");

        return response()->view("todolist.todolist",[
            "title" => "Todo List",
            "todolist" => $todoList
        ]);
    }

    public function addTodo(Request $request){
        $todo=$request->input("todo");
        $this->authLogger->info($request->session()->get('user')." add todo");

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
        $this->authLogger->info($request->session()->get('user')." remove todo");

        $this->todoListService->removeTodo($todoId);
        return redirect()->action([TodoListController::class,'todoList']);
    }
}
