<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Tasks | All Tasks</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
 <section class="py-5">
  <div class="container">
   <div class="card shadow">
    <div class="card-header d-flex align-items-center justify-content-between">
     <h3>All Tasks</h3>
     <a href="{{ route("tasks.create") }}" class="btn btn-primary">Create a new task</a>
    </div>
    <div class="card-body">
     @session('success')
     <div class="alert alert-success">{{ session("success") }}</div>
     @endsession
     <table class="table table-striped table-bordered">
      <thead>
        <tr class="table-dark">
          <th scope="col">ID</th>
          <th scope="col">Title</th>
          <th scope="col">Status</th>
          <th scope="col">Created At</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($tasks as $task)
          <tr>
            <td>{{ $task->id }}</td>
            <td>{{ $task->title }}</td>
            <td><span class="badge bg-{{ $task->status == 0 ? 'danger' : 'success' }}">{{ $task->status == 0 ? 'Incomplete' : 'Completed' }}</span></td>
            <td>{{ $task->created_at->diffForHumans() }}</td>
            <td class="d-flex gap-1">
              @if ($task->deleted_at)
              <form action="{{ route('tasks.restore', $task) }}" method="post">
                @csrf
                <button type="submit" class="btn btn-success btn-sm">Restore</button>
                </form>
                
                <form action="{{ route('tasks.force-delete', $task) }}" method="post">
                  @csrf
                  <button type="submit" class="btn btn-danger btn-sm">Force Delete</button>
                </form>
              @else
                <a href="{{ route("tasks.show", $task) }}" class="btn btn-primary btn-sm">View</a>
                <a href="{{ route("tasks.edit", $task) }}" class="btn btn-success btn-sm">Edit</a>
                <form action="{{ route('tasks.destroy', $task) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
              @endif
            </td>
          </tr>
        @empty
            <tr>
              <td colspan="5" class="text-center text-muted">There are no tasks available!</td>
            </tr>
        @endforelse
      </tbody>
    </table>
    </div>
   </div>
  </div>
 </section>
</body>
</html>