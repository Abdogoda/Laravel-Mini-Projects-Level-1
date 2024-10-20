<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>All roles</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
 <section class="py-5 mt-5">
  <div class="container">
   <div class="card shadow">
    <div class="card-header d-flex align-items-center justify-content-between">
        
     <h3>All roles</h3>
     <a href="{{route("roles.create")}}" class="btn btn-primary">Create a new role</a>
    </div>
    <div class="card-body">
     @session('success')
     <div class="alert alert-success">{{ session("success") }}</div>
     @endsession
     @session('error')
     <div class="alert alert-danger">{{ session("error") }}</div>
     @endsession
     <table class="table table-bordered table-striped">
      <thead>
       <tr class="table-dark">
        <th>ID</th>
        <th>Name</th>
        <th>Permission</th>
        <th>User</th>
        <th>Action</th>
       </tr>
      </thead>
      <tbody>
       @forelse ($roles as $role)
           <tr>
            <td>{{$role->id}}</td>
            <td>{{$role->name}}</td>
            <td>{{$role->permissions->count()}}</td>
            <td>{{$role->users->count()}}</td>
            <td class="d-flex gap-1">
             <a href="{{route("roles.edit", $role)}}" class="btn btn-success btn-sm">Edit</a>
             <form action="{{route("roles.destroy", $role)}}" method="post">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger btn-sm">Delete</button>
             </form>
            </td>
           </tr>
       @empty
       <tr>
        <td colspan="5" class="text-center text-muted">There are no roles available!</td>
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