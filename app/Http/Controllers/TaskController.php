<?php

namespace App\Http\Controllers;

use App\Models\Task;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(){
        $tasks = Task::latest()->get();
        return response()->json(['tasks'=> $tasks]);
    }

    public function store(){
        $task = new Task();
        $task->name = request('name');
        $task->description = request('description');
        $task->due_date = request('due_date');
        $task->priority = request('priority');
       

        $task->save();
        return response()->json(['message'=>'Task added succesfully'], 201);
    }

    public function show($id){
        $task = Task::findOrFail($id);

        return response()->json(['task' => $task]);

    }

    public function update($id){
        $task = Task::findOrFail($id);

        $task->name = request('name');
        $task->description = request('description');
        $task->due_date = request('due_date');
        $task->priority = request('priority');

        $task->save();

        return response()->json(['message' => 'Task updated succesfully!']);
    }


    public function destroy($id){
        $task = Task::findOrFail($id);

        $task->delete();
        return response()->json(['message' => 'Task deleted successfully!']);

    }
}
