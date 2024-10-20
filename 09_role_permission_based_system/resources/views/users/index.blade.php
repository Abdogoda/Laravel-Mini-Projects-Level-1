<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>All users</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
 <section class="py-5 mt-5">
  <div class="container">
   <div class="card shadow">
    <div class="card-header d-flex align-items-center justify-content-between">
        
     <h3>All users</h3>
     @hasPermission("create_user")
        <a href="{{route("users.create")}}" class="btn btn-primary">Create a new user</a>
     @endhasPermission
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
        <th>Email</th>
        <th>Role</th>
        <th>Action</th>
       </tr>
      </thead>
      <tbody>
       @forelse ($users as $user)
           <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td><span class="badge bg-success text-uppercase">{{$user->role->name}}</span></td>
            <td class="d-flex gap-1">
                @hasPermission("update_user")
                    <a href="{{route("users.edit", $user)}}" class="btn btn-success btn-sm">Edit</a>
                @endhasPermission
                @hasPermission("delete_user")
                    <form action="{{route("users.destroy", $user)}}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                @endhasPermission
            </td>
           </tr>
       @empty
       <tr>
        <td colspan="5" class="text-center text-muted">There are no users available!</td>
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