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

        // Mengambil data tugas yang selesai untuk tahun ini
        $taskCompleteMonthly = Task::where('status', 'complete')
            ->whereYear('updated_at', Carbon::now()->year) // Mengambil data tahun ini
            ->selectRaw('MONTH(updated_at) as month, COUNT(*) as task_count')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Menyiapkan data untuk grafik bulanan
        $months = [];
        $taskCounts = [];

        // Looping untuk mendapatkan jumlah tugas selesai setiap bulan dari Januari sampai Desember
        for ($i = 1; $i <= 12; $i++) {
            $months[] = Carbon::create()->month($i)->format('M'); // Menampilkan nama bulan
            $taskCounts[] = $taskCompleteMonthly->where('month', $i)->first()->task_count ?? 0; // Ambil jumlah tugas selesai, jika tidak ada maka 0
        }

        // Menghitung jumlah tugas per minggu
        $taskData = [];
        $weeks = [];
        for ($i = 1; $i <= 52; $i++) {
            $startOfWeek = Carbon::now()->startOfYear()->addWeeks($i - 1);
            $endOfWeek = Carbon::now()->startOfYear()->addWeeks($i)->subDay();

            $taskCount = Task::where('status', 'complete')
                ->whereBetween('updated_at', [$startOfWeek, $endOfWeek])
                ->count();

            $taskData[] = $taskCount;
            $weeks[] = 'Minggu ' . $i;
        }

        return view('admin.dashboard', compact('categorycount', 'usercount', 'taskcount', 'taskPending', 'months', 'taskCounts', 'taskData', 'weeks'));
    }
}
