<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $tasks = Task::when($search, function($query, $search) {
            return $query->where('judul', 'like', "%{$search}%");
        })->orderBy('deadline')->paginate(10);

        return view('tasks.index', compact('tasks', 'search'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'nullable',
            'deadline' => 'required|date|after_or_equal:today',
        ]);

        Task::create($request->all());

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'judul' => 'required',
            'deskripsi' => 'nullable',
            'deadline' => 'required|date|after_or_equal:today',
        ]);

        $task->update($request->all());

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil dihapus.');
    }
}