<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Menghitung kategori, pengguna, dan tugas
        $categorycount = Category::count();
        $usercount = User::count();
        $taskcount = Task::count();
        $taskPending = Task::where('status', 'pending')->count();

        $taskCompleteMonthly = Task::where('status', 'complete')
            ->whereYear('updated_at', Carbon::now()->year) // Mengambil data tahun ini
            ->selectRaw('MONTH(updated_at) as month, COUNT(*) as task_count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $months = [];
        $taskCounts = [];
        for ($i = 1; $i <= 12; $i++) {
            $months[] = Carbon::create()->month($i)->format('M');
            $taskCounts[] = $taskCompleteMonthly->where('month', $i)->first()->task_count ?? 0;
        }

        return view('admin.dashboard', compact('categorycount', 'usercount', 'taskcount', 'taskPending', 'months', 'taskCounts'));
    }
}
