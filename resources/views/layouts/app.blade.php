<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f4f6f8;
            font-family: Inter, system-ui, sans-serif;
            font-size: 14px;
            color: #1f2937;
        }
        .app-container { max-width: 1100px; }
        .app-title {
            font-size: 30px ;
            font-weight: 700 ;
            letter-spacing: 0.5px;
        }


        .tabs a.active {
            color: #111827;
            border-bottom: 2px solid #111827;
        }
        .task-card {
            background: #fff;
            border-radius: 8px;
            padding: 14px;
            border: 1px solid #e5e7eb;
            margin-bottom: 10px;
            display: flex;
            gap: 12px;
        }
        .task-title { font-weight: 600; }
        .task-desc { font-size: 13px; color: #6b7280; }
        .task-actions { margin-left: auto; display: flex; gap: 8px; }
    </style>
</head>

<body>

<div class="w-100 text-center">
    <span class="app-title">Task Manager</span>
</div>


<div class="container app-container">
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
