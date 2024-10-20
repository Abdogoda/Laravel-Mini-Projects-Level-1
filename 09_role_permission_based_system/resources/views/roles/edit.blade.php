<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Edit a role</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
 <section class="py-5 mt-5">
  <div class="container">
   <div class="card shadow">
    <div class="card-header d-flex align-items-center justify-content-between">
        
     <h3>Edit a role</h3>
     <a href="{{route("roles.index")}}" class="btn btn-primary">All roles</a>
    </div>
    <div class="card-body">
     @session('success')
     <div class="alert alert-success">{{ session("success") }}</div>
     @endsession
     @session('error')
     <div class="alert alert-danger">{{ session("error") }}</div>
     @endsession
     <form action="{{route("roles.update", $role)}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="name">Role name</label>
            <input type="text" id="name" name="name" class="form-control" value="{{$role->name}}">
        </div>
        <div class="form-group mb-3">
            <div class="d-flex flex-wrap gap-2">
                @foreach ($permissions as $permission)
                    <div class="p-2 border shadow-sm rounded">
                        <label for="{{$permission->id}}">{{$permission->name}}</label>
                        <input 
                            type="checkbox" 
                            name="permissions[]" 
                            id="{{$permission->id}}" 
                            value="{{$permission->id}}"
                            {{$role->hasPermission($permission->id) ? 'checked' : ''}}
                        >
                    </div>
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-success">Save Changes</button>
     </form>
    </div>
   </div>
  </div>
 </section>
</body>
</html>