<?php

namespace App\Http\Controllers;

use App\Models\TaskList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskListController extends Controller
{

    public function index(Request $request)
    {
        $searchKeyword = $request->query('search_keyword');

        $taskLists = TaskList::where('user_id', Auth::id())
            ->when($searchKeyword, function ($query, $searchKeyword) {
                return $query->where('name', 'like', '%' . $searchKeyword . '%');
            })
            ->paginate(10);

        return view('user.task-lists.list', compact('taskLists'));
    }
    public function create()
    {
        return view('user.task-lists.add');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        TaskList::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
        ]);

        return redirect()->route('user.list.list')->with('success', 'Data berhasil dibuat');
    }

    public function edit(TaskList $taskList)
    {
        return view('user.task-lists.update', compact('taskList'));
    }

    public function update(Request $request, TaskList $taskList)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $taskList->update([
            'name' => $request->name,
        ]);

        return redirect()->route('user.list.list')->with('success', 'Data berhasil diperbarui');
    }

    public function destroy(TaskList $taskList)
    {
        $taskList->delete();
        return redirect()->route('user.list.list')->with('success', 'Data berhasil dihapus');
    }
}
