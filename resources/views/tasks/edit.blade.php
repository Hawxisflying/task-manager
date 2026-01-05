@extends('layouts.app')

@section('content')

<h3>Edit Task</h3>

<div class="card p-4">
<form method="POST" action="{{ route('tasks.update',$task->id) }}">
@csrf
@method('PUT')

<div class="mb-3">
    <label class="form-label">Title *</label>
    <input type="text" name="title" value="{{ $task->title }}" class="form-control" required>
</div>

<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control">{{ $task->description }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Priority</label>
    <select name="priority" class="form-select">
        <option {{ $task->priority=='High'?'selected':'' }}>High</option>
        <option {{ $task->priority=='Medium'?'selected':'' }}>Medium</option>
        <option {{ $task->priority=='Low'?'selected':'' }}>Low</option>
    </select>
</div>

<button class="btn btn-primary">Update Task</button>
<a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back</a>

</form>
</div>

@endsection
