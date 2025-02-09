<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use App\Models\TaskList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class UserDashboardController extends Controller
{
    public function index()
    {
        // Ambil data berdasarkan user yang sedang login
        $user = Auth::user();

        // Menghitung jumlah kategori
        $categoryCount = Category::count();

        // Menghitung jumlah task list yang dimiliki oleh user
        $taskListCount = TaskList::where('user_id', $user->id)->count();

        // Menghitung jumlah task yang dimiliki oleh user
        $taskCount = Task::where('user_id', $user->id)->count();

        // Menghitung jumlah task berdasarkan status
        $pendingTasks = Task::where('user_id', $user->id)->where('status', 'pending')->count();
        $inProgressTasks = Task::where('user_id', $user->id)->where('status', 'In Progress')->count();
        $completedTasks = Task::where('user_id', $user->id)->where('status', 'completed')->count();
        $overdueTasks = Task::where('user_id', $user->id)->where('deadline', '<', now())->where('status', '!=', 'completed')->count();

        // Mengambil tugas yang terbaru
        $recentTasks = Task::where('user_id', $user->id)->latest()->take(5)->get();

        // Mengambil jumlah tugas per bulan untuk user yang login
        $taskCounts = Task::where('user_id', $user->id)
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('count(*) as count'))
            ->groupBy(DB::raw('MONTH(created_at)'))
            ->orderBy('month', 'asc')
            ->get();

        // Mengubah data bulan dan count menjadi array untuk chart
        $months = $taskCounts->pluck('month');
        $taskData = $taskCounts->pluck('count');

        return view('user.dashboard', compact(
            'categoryCount',
            'taskListCount',
            'taskCount',
            'pendingTasks',
            'inProgressTasks',
            'completedTasks',
            'overdueTasks',
            'recentTasks',
            'months',
            'taskData'
        ));
    }
}
