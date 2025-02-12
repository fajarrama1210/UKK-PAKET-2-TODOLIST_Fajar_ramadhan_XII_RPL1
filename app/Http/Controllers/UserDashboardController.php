<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\Category;
use App\Models\TaskList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

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

        // Menghitung jumlah tugas per minggu berdasarkan kolom `date`
        $taskCountsPerWeek = Task::where('user_id', $user->id)
            ->selectRaw('YEARWEEK(date, 1) as week, COUNT(*) as task_count')
            ->groupBy('week')
            ->orderBy('week')
            ->get();

        // Format data untuk chart
        $weeks = [];
        $taskData = [];
        foreach ($taskCountsPerWeek as $task) {
            $weekStart = Carbon::createFromFormat('Y-m-d', date('Y-m-d', strtotime(substr($task->week, 0, 4) . '-01-01')))
                ->addWeeks(substr($task->week, 4) - 1)
                ->format('M d');
            $weeks[] = $weekStart;
            $taskData[] = $task->task_count;
        }

        return view('user.dashboard', compact(
            'categoryCount',
            'taskListCount',
            'taskCount',
            'pendingTasks',
            'inProgressTasks',
            'completedTasks',
            'overdueTasks',
            'recentTasks',
            'weeks',
            'taskData'
        ));
    }}
