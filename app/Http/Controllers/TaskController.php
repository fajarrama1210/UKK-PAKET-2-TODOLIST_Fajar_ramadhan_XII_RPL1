<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Category;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Task::where('user_id', Auth::id());

        if ($request->has('filter_kategori') && $request->filter_kategori != '') {
            $query->where('category_id', $request->filter_kategori);
        }
        if ($request->has('filter_status') && $request->filter_status != '') {
            $query->where('status', $request->filter_status);
        }
        if ($request->has('filter_prioritas') && $request->filter_prioritas != '') {
            $query->where('priority', $request->filter_prioritas);
        }
        if ($request->has('filter_bulan') && $request->filter_bulan != '') {
            $query->whereMonth('date', $request->filter_bulan);
        }
        if ($request->has('filter_tahun') && $request->filter_tahun != '') {
            $query->whereYear('date', $request->filter_tahun);
        }

        $tasks = $query->orderBy('created_at', 'desc')->get();
        $categories = Category::all();

        return view('user.task.list', compact('tasks', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('user.task.add', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        $request->validated();
        Task::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'category_id' => $request->category_id,
            'priority' => $request->priority,
            'date' => $request->date,
            'time' => $request->time,
            'description' => $request->description,
            'deadline' => $request->deadline ?? null,
            'status' => 'Pending',
        ]);


        return redirect()->route('user.tasks.list')->with('success', 'Data berhasil ditambahkan');
    }
    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('user.task.detail', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $categories = Category::all();
        return view('user.task.update', compact('task', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $request->validated();

        $time = \Carbon\Carbon::createFromFormat('H:i', $request->time)->format('H:i');
        $task->update([
            'name' => $request->name,
            'category_id' => $request->category_id,
            'priority' => $request->priority,
            'status' => $request->status,
            'date' => $request->date,
            'time' => $time,
            'description' => $request->description,
            'deadline' => $request->deadline ?? $task->deadline,
        ]);

        return redirect()->route('user.tasks.list')->with('success', 'Data berhasil diperbarui');
    }
        /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('user.tasks.list')->with('success', 'Data berhasil dihapus');
    }
}
