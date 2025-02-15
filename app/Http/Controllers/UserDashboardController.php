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
            ->whereBetween('created_at', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d 23:59:59')])
            ->selectRaw('DATE(CONVERT_TZ(created_at, "+00:00", "+07:00")) as date, COUNT(*) as count')
            ->groupBy(DB::raw('DATE(CONVERT_TZ(created_at, "+00:00", "+07:00"))'))
            ->get()
            ->keyBy('date');

        // Query data tugas selesai harian
        $dailyCompleted = Task::where('user_id', $user->id)
            ->where('status', 'completed')
            ->whereBetween('updated_at', [$startDate->format('Y-m-d'), $endDate->format('Y-m-d 23:59:59')])
            ->selectRaw('DATE(CONVERT_TZ(updated_at, "+00:00", "+07:00")) as date, COUNT(*) as count')
            ->groupBy(DB::raw('DATE(CONVERT_TZ(updated_at, "+00:00", "+07:00"))'))
            ->get()
            ->keyBy('date');

        // Format data untuk chart
        $formattedDates = [];
        $taskData = [];
        $completedData = [];

        foreach ($dateRange as $date) {
            $formattedDate = Carbon::createFromFormat('Y-m-d', $date, $timezone)->format('d M');
            $formattedDates[] = $formattedDate;

            $taskData[] = $dailyTasks->has($date) ? $dailyTasks[$date]->count : 0;
            $completedData[] = $dailyCompleted->has($date) ? $dailyCompleted[$date]->count : 0;
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
