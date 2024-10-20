<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>@yield('title')</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
 <section class="py-5">
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
    @yield('content')
   </div>
  </div>
 </section>
</body>
</html>