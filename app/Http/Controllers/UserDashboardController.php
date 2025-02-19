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
        $user = Auth::user();
        $timezone = 'Asia/Jakarta';

        // Hitung tanggal mulai dan akhir (7 hari terakhir)
        $endDate = Carbon::now($timezone);
        $startDate = Carbon::now($timezone)->subDays(6);

        // Generate array tanggal untuk 7 hari terakhir
        $dateRange = [];
        $currentDate = $startDate->copy();

        while ($currentDate <= $endDate) {
            $dateRange[] = $currentDate->format('Y-m-d');
            $currentDate->addDay();
        }

        // Query data tugas harian
        $dailyTasks = Task::where('user_id', $user->id)
            ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->get()
            ->groupBy(function($task) use ($timezone) {
                return Carbon::parse($task->created_at)->setTimezone($timezone)->format('Y-m-d');
            });

        // Query data tugas selesai harian
        $dailyCompleted = Task::where('user_id', $user->id)
            ->where('status', 'completed')
            ->whereBetween('updated_at', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->get()
            ->groupBy(function($task) use ($timezone) {
                return Carbon::parse($task->updated_at)->setTimezone($timezone)->format('Y-m-d');
            });

        // Format data untuk chart
        $formattedDates = [];
        $taskData = [];
        $completedData = [];

        foreach ($dateRange as $date) {
            $formattedDate = Carbon::createFromFormat('Y-m-d', $date, $timezone)->format('d M');
            $formattedDates[] = $formattedDate;

            // Data tugas dibuat
            $taskData[] = isset($dailyTasks[$date]) ? $dailyTasks[$date]->count() : 0;

            // Data tugas selesai
            $completedData[] = isset($dailyCompleted[$date]) ? $dailyCompleted[$date]->count() : 0;
        }

        // Statistik lainnya (opsional)
        $categoryCount = Category::count();
        $taskListCount = TaskList::where('user_id', $user->id)->count();
        $taskCount = Task::where('user_id', $user->id)->count();
        $pendingTasks = Task::where('user_id', $user->id)->where('status', 'pending')->count();
        $inProgressTasks = Task::where('user_id', $user->id)->where('status', 'In Progress')->count();
        $completedTasks = Task::where('user_id', $user->id)->where('status', 'completed')->count();
        $overdueTasks = Task::where('user_id', $user->id)
            ->where('deadline', '<', now())
            ->where('status', '!=', 'completed')
            ->count();

        return view('user.dashboard', compact(
            'categoryCount',
            'taskListCount',
            'taskCount',
            'pendingTasks',
            'inProgressTasks',
            'completedTasks',
            'overdueTasks',
            'formattedDates',
            'taskData',
            'completedData'
        ));
    }
}
