<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Profile</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
 <section class="py-5 mt-5">
  <div class="container">
   <div class="mb-3">
    @session('success')
    <div class="alert alert-success">{{ session("success") }}</div>
    @endsession
    @session('error')
    <div class="alert alert-danger">{{ session("error") }}</div>
    @endsession
   </div>
   <div class="card shadow">
    <div class="card-header d-flex align-items-center justify-content-between">
     <h3>Profile</h3>
     <form action="{{ route("logout") }}" method="post">
      @csrf
      <button type="submit" class="btn btn-danger">Logout</button>
     </form>
    </div>
    <div class="card-body">
     <form action="" method="post">
      @csrf
      <div class="form-group mb-3">
       <label for="name">Full Name</label>
       <input type="text" name="name" id="name" class="form-control" value="{{ auth()->user()->name }}">
       @error('name')
           <span class="text-danger">{{ $message }}</span>
       @enderror
      </div>
      <div class="form-group mb-3">
       <label for="email">Email Address</label>
       <input type="email" name="email" id="email" class="form-control" value="{{ auth()->user()->email }}">
       @error('email')
           <span class="text-danger">{{ $message }}</span>
       @enderror
      </div>
      <button type="submit" class="btn btn-success">Save Changes</button>
     </form>
    </div>
   </div>

   <div class="card shadow mt-3">
    <div class="card-header d-flex align-items-center justify-content-between">
     <h3>Change Password</h3>
    </div>
    <div class="card-body">
     <form action="{{ route("profile.change-password") }}" method="post">
      @csrf
      <div class="form-group mb-3">
       <label for="current_password">Current Password</label>
       <input type="password" name="current_password" id="current_password" class="form-control">
       @error('current_password')
           <span class="text-danger">{{ $message }}</span>
       @enderror
      </div>
      <div class="form-group mb-3">
       <label for="password">New Password</label>
       <input type="password" name="password" id="password" class="form-control">
       @error('password')
           <span class="text-danger">{{ $message }}</span>
       @enderror
      </div>
      <div class="form-group mb-3">
       <label for="password_confirmation">New Password Confirmation</label>
       <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
      </div>
      <button type="submit" class="btn btn-success">Save Changes</button>
     </form>
    </div>
   </div>
  </div>
 </section>
</body>
</html>