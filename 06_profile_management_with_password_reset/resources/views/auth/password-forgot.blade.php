<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>Password Forgot Page</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
 <section class="py-5 mt-5">
  <div class="container" style="width: 500px; max-width:100%">
   <div class="card shadow">
    <div class="card-body">
     <h3 class="mb-3 text-center">Forgot your password?</h3>
     @session('success')
     <div class="alert alert-success">{{ session("success") }}</div>
     @endsession
     @session('error')
     <div class="alert alert-danger">{{ session("error") }}</div>
     @endsession
     <form method="POST" action="">
      @csrf
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" autocomplete="email" value="{{ old("email") }}">
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary w-100">Submit</button>
    </form>
    </div>
   </div>
  </div>
 </section>
</body>
</html>