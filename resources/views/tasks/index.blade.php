@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Daftar Tugas</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('tasks.index') }}" class="mb-3">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Cari judul tugas..." value="{{ $search }}">
            <button class="btn btn-primary">Cari</button>
        </div>
    </form>

    <a href="{{ route('tasks.create') }}" class="btn btn-success mb-3">+ Tambah Tugas</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Deskripsi</th>
                <th>Deadline</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tasks as $task)
            <tr>
                <td>{{ $task->judul }}</td>
                <td>{{ $task->deskripsi }}</td>
                <td>{{ $task->deadline }}</td>
                <td>
                    <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST" style="display:inline-block">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus tugas?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $tasks->links() }}
</div>
@endsection