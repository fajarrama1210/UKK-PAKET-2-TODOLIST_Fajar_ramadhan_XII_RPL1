<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Category;
use App\Models\TaskList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, TaskList $taskList)
    {
        // Query dasar
        $query = Task::where('user_id', Auth::id())
            ->where('list_id', $taskList->id);

        // Periksa dan perbarui status tugas yang sudah melewati deadline
        $tasksToUpdate = Task::where('user_id', Auth::id())
            ->where('list_id', $taskList->id)
            ->where('deadline', '<', now())
            ->where('status', '!=', 'completed')
            ->get();

        foreach ($tasksToUpdate as $task) {
            $task->status = 'overdue';
            $task->save();
        }

        // Fitur Pencarian
        if ($request->has('search_keyword') && $request->search_keyword != '') {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search_keyword . '%')
                    ->orWhere('description', 'like', '%' . $request->search_keyword . '%');
            });
        }

        // Filter Kategori
        if ($request->has('filter_kategori') && $request->filter_kategori != '') {
            $query->where('category_id', $request->filter_kategori);
        }

        // Filter Status
        if ($request->has('filter_status') && $request->filter_status != '') {
            $query->where('status', $request->filter_status);
        }

        // Filter Prioritas
        if ($request->has('filter_prioritas') && $request->filter_prioritas != '') {
            $query->where('priority', $request->filter_prioritas);
        }

        // Pagination dan Pengurutan
        $tasks = $query->orderBy('created_at', 'desc')->paginate(10);
        $categories = Category::all();

        return view('user.task.list', compact('tasks', 'categories', 'taskList'));
    }    /**
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
        $listid = $request->list_id;
        $request->validated();
        Task::create([
            'user_id' => Auth::id(),
            'list_id' => $listid,
            'name' => $request->name,
            'category_id' => $request->category_id,
            'priority' => $request->priority,
            'date' => $request->date,
            'time' => $request->time,
            'description' => $request->description,
            'deadline' => $request->deadline ?? null,
            'status' => 'Pending',
        ]);


        return redirect()->route('user.tasks.list.filter', ['taskList' => $request->list_id])->with('success', 'Data berhasil ditambahkan');
    }
    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        // Mendapatkan list_id dari task atau sesuaikan dengan struktur data Anda
        $list_id = $task->list_id;

        // Mengirimkan data task dan list_id ke tampilan
        return view('user.task.detail', compact('task', 'list_id'));
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
        // $listid = $request->list_id;

        $taskList = TaskList::where('user_id', Auth::id())->first();

        if (!$taskList) {
            return redirect()->route('user.tasks.list')->with('error', 'Task List tidak ditemukan');
        }

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

        return redirect()->route('user.tasks.list.filter', ['taskList' => $task->list_id])->with('success', 'Data berhasil diperbarui');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task, $listid)
    {
        // Validasi bahwa task milik user yang sedang login
        if ($task->user_id !== Auth::id()) {
            return redirect()->route('user.tasks.list')->with('error', 'Unauthorized action');
        }

        $task->delete();

        return redirect()->route('user.tasks.list.filter', ['taskList' => $listid])->with('success', 'Data berhasil dihapus');
    }
}
