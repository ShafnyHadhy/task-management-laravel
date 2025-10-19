<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();

        if($user->role === 'admin')
        {
            $tasks = Task::with(['user', 'category'])
                    ->latest()
                    ->paginate(6);
        }
        else
        {
            $tasks = Task::with(['category'])
                     ->where('user_id', $user->id)
                     ->latest()
                     ->paginate(10);
        }

        return view('task.index', ["tasks" => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $users = User::all();

        return view('task.create', ['categories' => $categories, 'users' => $users,]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            "task_name" => "required|string",
            "description" => "required|string",
            "category_id" => "required|string",
            "deadline" => "required|string",
            "status" => "required|string",
            "user_id" => "required|string",
        ]);

        Task::create($data);

        return to_route("task.index")->with("success", "Task created successfully!");

    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('task.show', ["task" => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $categories = Category::all();
        $users = User::all();

        return view('task.edit', ["task" => $task, 'categories' => $categories, 'users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        if (Auth::user()->role === 'admin') {

            $data = $request->validate([
                "task_name"   => "required|string",
                "description" => "required|string",
                "category_id" => "required|string",
                "deadline"    => "required|date",
                "status"      => "required|string",
                "user_id"     => "required|string",
            ]);
        } else {

            $data = $request->validate([
                "status" => "required|string",
            ]);
        }

        $task->update($data);

        return to_route("task.index")->with("success", "Task updated successfully!");
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {

        $task->delete();

        return to_route("task.index")->with("success", "Task deleted successfully!");
    }
}
