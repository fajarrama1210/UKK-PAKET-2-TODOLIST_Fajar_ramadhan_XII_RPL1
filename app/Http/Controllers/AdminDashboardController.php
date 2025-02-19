<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{

    public function index()
    {
        // Menghitung kategori, pengguna, dan tugas
        $categorycount = Category::count();
        $usercount = User::count();
        $taskcount = Task::count();
        $taskPending = Task::where('status', 'pending')->count();

        // Hitung tanggal mulai dan akhir (7 hari terakhir)
        $endDate = Carbon::now();  // Tanggal sekarang
        $startDate = Carbon::now()->subDays(6); // 7 hari terakhir, termasuk hari ini

        // Generate array tanggal untuk 7 hari terakhir
        $dateRange = [];
        $currentDate = $startDate->copy();

        while ($currentDate <= $endDate) {
            $dateRange[] = $currentDate->format('Y-m-d');
            $currentDate->addDay();
        }

        // Query data tugas harian untuk 7 hari terakhir
        $dailyTasks = Task::whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy(DB::raw('DATE(created_at)'))  // Menggunakan DATE(created_at) dalam GROUP BY
            ->get()
            ->keyBy('date');

        // Query data tugas selesai harian untuk 7 hari terakhir
        $dailyCompleted = Task::where('status', 'completed') // Pastikan status yang digunakan adalah 'completed'
            ->whereBetween('created_at', [$startDate, $endDate]) // Gunakan created_at atau kolom khusus untuk tanggal selesai
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy(DB::raw('DATE(created_at)'))  // Menggunakan DATE(created_at) dalam GROUP BY
            ->get()
            ->keyBy('date');

        // Format data untuk chart
        $formattedDates = [];
        $taskData = [];
        $completedData = [];

        foreach ($dateRange as $date) {
            $formattedDate = Carbon::createFromFormat('Y-m-d', $date)->format('d M');  // Format tanggal
            $formattedDates[] = $formattedDate;

            // Ambil jumlah tugas atau setel ke 0 jika tidak ada data
            $taskData[] = $dailyTasks->has($date) ? $dailyTasks[$date]->count : 0;
            $completedData[] = $dailyCompleted->has($date) ? $dailyCompleted[$date]->count : 0;
        }

        return view('admin.dashboard', compact('categorycount', 'usercount', 'taskcount', 'taskPending', 'formattedDates', 'taskData', 'completedData'));
    }    }
