@extends('layouts.app')

@section('content')

{{-- HEADER + ADD BUTTON --}}
<div class="d-flex justify-content-between align-items-center mb-3">
    <h4 class="fw-semibold mb-0">Tasks</h4>

    <a href="{{ route('tasks.create') }}" class="btn btn-dark">
        + New Task
    </a>
</div>

{{-- SEARCH --}}
<input type="text"
       id="searchInput"
       value="{{ $search }}"
       class="form-control mb-3"
       placeholder="Search tasks (type to search)"
       autocomplete="off">

{{-- TABS --}}
<ul class="nav nav-pills mb-4">
    <li class="nav-item">
        <a class="nav-link {{ $view=='all' ? 'active' : '' }}"
           href="{{ route('tasks.index', ['view'=>'all','search'=>$search]) }}">
            All
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $view=='pending' ? 'active' : '' }}"
           href="{{ route('tasks.index', ['view'=>'pending','search'=>$search]) }}">
            Pending ({{ $pendingCount }})
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ $view=='completed' ? 'active' : '' }}"
           href="{{ route('tasks.index', ['view'=>'completed','search'=>$search]) }}">
            Completed ({{ $completedCount }})
        </a>
    </li>
</ul>

{{-- RESULTS --}}
<div id="taskResults">

{{-- ================= PENDING ================= --}}
@if($view === 'all' || $view === 'pending')

<h5 class="fw-semibold mb-2">Pending Tasks</h5>

@if($tasks->where('status','Pending')->count() === 0)
    <p class="text-muted">No pending tasks.</p>
@else
<table class="table table-sm align-middle bg-white mb-5">
    <thead>
        <tr>
            <th width="40"></th>
            <th>Task</th>
            <th width="120">Priority</th>
            <th width="160">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($tasks->where('status','Pending') as $task)
        <tr>
            <td>
                <form method="POST" action="{{ route('tasks.toggle',$task->id) }}">
                    @csrf
                    @method('PATCH')
                    <input type="checkbox" onchange="this.form.submit()">
                </form>
            </td>

            <td>
                <strong>{{ $task->title }}</strong><br>
                <span class="text-muted">{{ $task->description }}</span>
            </td>

            <td>{{ $task->priority }}</td>

            <td>
                <a href="{{ route('tasks.edit',$task->id) }}"
                   class="btn btn-sm btn-outline-secondary">
                    Edit
                </a>

                <button type="button"
                        class="btn btn-sm btn-outline-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteModal{{ $task->id }}">
                    Delete
                </button>
            </td>
        </tr>

        {{-- DELETE MODAL --}}
        <div class="modal fade" id="deleteModal{{ $task->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Delete Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        Are you sure you want to delete
                        <strong>"{{ $task->title }}"</strong>?
                        <br>This action cannot be undone.
                    </div>

                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <form method="POST" action="{{ route('tasks.destroy',$task->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">
                                Yes, Delete
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    @endforeach
    </tbody>
</table>
@endif

@endif

{{-- ================= COMPLETED ================= --}}
@if($view === 'all' || $view === 'completed')

<h5 class="fw-semibold mb-2">Completed Tasks</h5>

@if($tasks->where('status','Completed')->count() === 0)
    <p class="text-muted">No completed tasks.</p>
@else
<table class="table table-sm align-middle bg-white">
    <thead>
        <tr>
            <th width="40"></th>
            <th>Task</th>
            <th width="120">Priority</th>
            <th width="160">Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach($tasks->where('status','Completed') as $task)
        <tr>
            <td>
                <form method="POST" action="{{ route('tasks.toggle',$task->id) }}">
                    @csrf
                    @method('PATCH')
                    <input type="checkbox" checked onchange="this.form.submit()">
                </form>
            </td>

            <td>
                <strong>{{ $task->title }}</strong><br>
                <span class="text-muted">{{ $task->description }}</span>
            </td>

            <td>{{ $task->priority }}</td>

            <td>
                <a href="{{ route('tasks.edit',$task->id) }}"
                   class="btn btn-sm btn-outline-secondary">
                    Edit
                </a>

                <button type="button"
                        class="btn btn-sm btn-outline-danger"
                        data-bs-toggle="modal"
                        data-bs-target="#deleteModal{{ $task->id }}">
                    Delete
                </button>
            </td>
        </tr>

        {{-- DELETE MODAL --}}
        <div class="modal fade" id="deleteModal{{ $task->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Delete Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body">
                        Are you sure you want to delete
                        <strong>"{{ $task->title }}"</strong>?
                        <br>This action cannot be undone.
                    </div>

                    <div class="modal-footer">
                        <button type="button"
                                class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <form method="POST" action="{{ route('tasks.destroy',$task->id) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">
                                Yes, Delete
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    @endforeach
    </tbody>
</table>
@endif

@endif

</div>

{{-- LIVE SEARCH (NO CURSOR JUMP) --}}
<script>
let timer = null;
const input = document.getElementById('searchInput');
const results = document.getElementById('taskResults');

input.focus();

input.addEventListener('input', function () {
    clearTimeout(timer);

    timer = setTimeout(() => {
        const params = new URLSearchParams(window.location.search);
        params.set('search', input.value);

        fetch(`{{ route('tasks.index') }}?${params.toString()}`, {
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(res => res.text())
        .then(html => {
            const doc = new DOMParser().parseFromString(html, 'text/html');
            const newResults = doc.getElementById('taskResults');
            if (newResults) {
                results.innerHTML = newResults.innerHTML;
            }
        });
    }, 300);
});
</script>

@endsection
