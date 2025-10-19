<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function adminDashboard()
    {
        $user = Auth::user();

        $cateCount = Category::all()
                        ->count();

        $taskCount = Task::all()
                        ->count();

        $usersCount = User::all()
                        ->count();

        $tasks = Task::latest()
                    ->take(5)
                    ->get();


        return view('admin.adminhome', compact('cateCount', 'taskCount', 'usersCount', 'tasks'));
    }

    public function userDashboard()
    {
        $user = Auth::user();

        $pending = Task::where('user_id', $user->id)
                            ->where('status', 'pending')
                            ->count();

        $inProgress = Task::where('user_id', $user->id)
                            ->where('status', 'in-progress')
                            ->count();

        $completed = Task::where('user_id', $user->id)
                            ->where('status', 'completed')
                            ->count();

        $toComplete = Task::where('user_id', $user->id)
                            ->whereIn('status', ['pending', 'in-progress'])
                            ->latest()
                            ->take(5)
                            ->get()
                            ->map(function ($task) {
                                $deadline = Carbon::parse($task->deadline)->startOfDay();
                                $now = Carbon::now()->startOfDay();

                                $task->days_left = $now->diffInDays($deadline, false);
                                return $task;
                            });

        return view('dashboard', compact('pending', 'inProgress', 'completed', 'toComplete'));
    }
}
