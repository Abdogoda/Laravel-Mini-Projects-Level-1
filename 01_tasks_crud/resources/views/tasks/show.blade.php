<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Tasks | Task Details</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
 <section class="py-5">
  <div class="container">
   <div class="card shadow">
    <div class="card-header d-flex align-items-center justify-content-between">
     <h3>Task Details</h3>
     <a href="{{ route("tasks.index") }}" class="btn btn-primary">View all tasks</a>
    </div>
    <div class="card-body">
     @session('success')
     <div class="alert alert-success">{{ session("success") }}</div>
     @endsession
     <p><b>Title: </b>{{ $task->title }}</p>
     <p><b>Status: </b><span class="badge bg-{{ $task->status == 0 ? 'danger' : 'success' }}">{{ $task->status == 0 ? 'Incomplete' : 'Completed' }}</span></p>
     <p><b>Created at: </b>{{ $task->created_at->diffForHumans() }}</p>
     <p>{{ $task->description }}</p>
     <div class="d-flex gap-1">
      <a href="{{ route("tasks.edit", $task) }}" class="btn btn-success">Edit</a>
      <button class="btn btn-danger">Delete</button>
     </div>
    </div>
   </div>
  </div>
 </section>
</body>
</html>