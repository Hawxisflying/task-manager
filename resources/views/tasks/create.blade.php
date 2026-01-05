@extends('layouts.app')

@section('content')
<h4 class="fw-semibold mb-4 ms-1">Add New Task</h4>

<!-- <h3>Add New Task</h3> -->

<div class="card p-4">
<form method="POST" action="{{ route('tasks.store') }}">
@csrf

<div class="mb-3">
    <label class="form-label">Title *</label>
    <input type="text" name="title" class="form-control" required>
</div>

<div class="mb-3">
    <label class="form-label">Description</label>
    <textarea name="description" class="form-control"></textarea>
</div>

<div class="mb-3">
    <label class="form-label">Priority</label>
    <select name="priority" class="form-select">
        <option>High</option>
        <option>Medium</option>
        <option>Low</option>
    </select>
</div>


<button class="btn btn-success">Save Task</button>
<a href="{{ route('tasks.index') }}" class="btn btn-secondary">Back</a>

</form>
</div>

@endsection
