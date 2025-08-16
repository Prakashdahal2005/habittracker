<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Habits</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .habit-card {
            margin-bottom: 15px;
            padding: 15px;
            border-radius: 10px;
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
        }
        .habit-actions button {
            margin-left: 5px;
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4 text-center">My Habits</h1>

    <!-- Add new habit -->
    <div class="mb-4">
        <form method="POST" action="/" class="d-flex gap-2"  autocomplete="off">
            @csrf
            <input type="text" name="name" placeholder="New habit" class="form-control" required>
            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>

    <!-- Habit List -->
    <ul class="list-unstyled">
        @foreach ($habits as $habit)
            <li class="habit-card d-flex justify-content-between align-items-center">
                <div>
                    <strong>{{ $habit->name }}</strong> 
                    <span class="badge 
                        @if($habit->status=='pending') bg-warning 
                        @elseif($habit->status=='done') bg-success 
                        @else bg-secondary 
                        @endif">
                        {{ ucfirst($habit->status) }}
                    </span>
                </div>

                <div class="habit-actions d-flex align-items-center">
                    <!-- Update status -->
                    <form method="POST" action="/" class="d-flex align-items-center gap-2 m-0">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="id" value="{{ $habit->id }}">
                        <select name="status" class="form-select form-select-sm">
                            <option value="pending" @if($habit->status=='pending') selected @endif>Pending</option>
                            <option value="done" @if($habit->status=='done') selected @endif>Done</option>
                            <option value="skipped" @if($habit->status=='skipped') selected @endif>Skipped</option>
                        </select>
                        <button type="submit" class="btn btn-sm btn-outline-success">Update</button>
                    </form>

                    <!-- Delete -->
                    <form method="POST" action="/" class="m-0">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="id" value="{{ $habit->id }}">
                        <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
