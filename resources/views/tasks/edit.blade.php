@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Tugas</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" class="form-control" value="{{ $task->judul }}" required>
        </div>
        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control">{{ $task->deskripsi }}</textarea>
        </div>
        <div class="mb-3">
            <label>Deadline</label>
            <input type="date" name="deadline" class="form-control" value="{{ $task->deadline }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection