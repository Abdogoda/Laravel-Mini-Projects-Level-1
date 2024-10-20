<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Register Page</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
 <section class="py-5">
  <div class="container" style="width: 600px; max-width:100%">
   <div class="card shadow">
    <div class="card-body">
     <h3 class="mb-3 col-12 text-center">Sign Up Form</h3>
     @session('success')
     <div class="alert alert-success">{{ session("success") }}</div>
     @endsession
     @session('error')
     <div class="alert alert-danger">{{ session("error") }}</div>
     @endsession
     <form method="POST" action="{{ route("register.store") }}" enctype="multipart/form-data">
       @csrf
       <div class="row">
      <div class="mb-3 col-md-12">
        <label for="name" class="form-label">Full Name</label>
          <input type="text" class="form-control" id="name" name="name" autocomplete="name" autofocus value="{{ old('name') }}">
          @error('name')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="mb-3 col-md-12">
          <label for="email" class="form-label">Email address</label>
          <input type="email" class="form-control" id="email" name="email" autocomplete="email" value="{{ old("email") }}">
          @error('email')
              <span class="text-danger">{{ $message }}</span>
              @enderror
        </div>
        <div class="mb-3 col-md-6">
          <label for="role" class="form-label">Choose Role</label>
          <select name="role" id="role" class="form-control">
            <option value="user">User</option>
            <option value="teacher">Teacher</option>
          </select>
          @error('role')
              <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="mb-3 col-md-6">
          <label for="image" class="form-label">Choose Image</label>
          <input type="file" name="image" id="image" class="form-control" accept="image/*">
          @error('image')
          <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="mb-3 col-6">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" autocomplete="new-password">
          @error('password')
              <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        <div class="mb-3 col-6">
          <label for="password_confirmation" class="form-label">Password Confirmation</label>
          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" autocomplete="new-password">
        </div>
      </div>
      <p>Already have an account? <a href="{{ route("login") }}">Login Now</a></p>
      <button type="submit" class="btn btn-primary w-100">Submit</button>
    </form>
    </div>
   </div>
  </div>
 </section>
</body>
</html>