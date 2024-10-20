<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="ie=edge">
 <title>All Products</title>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
 <section class="my-5">
  <div class="container">
   <div class="card shadow mb-3">
    <form action="/products" method="get" class="card-body">
     <div class="row">
      <div class="col-md-6 mb-3">
       <label for="search">Search by name</label>
       <input type="search" name="search" id="search" class="form-control" value="{{ request("search") }}">
      </div>
      @php
          $categories = ['Electronics', 'Kitchen Tools', 'TV', 'Mobile', 'Watch', 'Laptop', 'Sports'];
      @endphp
      <div class="col-md-6 mb-3">
       <label for="category">Filter by category</label>
       <select name="category" id="category" class="form-control">
        <option value="all" selected>All Categories</option>
        @foreach ($categories as $category)
            <option value="{{ $category }}" {{ $category == request("category", 'all') ? 'selected' :'' }}>{{ $category }}</option>
        @endforeach
       </select>
      </div>
      <div class="col-md-6 mb-3">
       <label for="min_price" class="form-label">Min Price (<span id="min_price_span">{{ request("min_price", 0) }}</span> EGP)</label>
       <input type="range" class="form-range" id="min_price" name="min_price" min="0" max="10000" value="{{ request("min_price", 0) }}" oninput="updateMinPrice(this.value)">
      </div>
      <div class="col-md-6 mb-3">
       <label for="max_price" class="form-label">Max Price (<span id="max_price_span">{{ request("max_price", 10000) }}</span> EGP)</label>
       <input type="range" class="form-range" id="max_price" name="max_price" min="0" max="10000" value="{{ request("max_price", 10000) }}" oninput="updateMaxPrice(this.value)">
      </div>
      @php
          $sorting_by_array = ['id', 'name', 'price', 'created_at'];
      @endphp
      <div class="col-md-6 mb-3">
       <label for="sorting_by">Sorting By</label>
       <select name="sorting_by" id="sorting_by" class="form-control">
        @foreach ($sorting_by_array as $sorting_by)
            <option value="{{ $sorting_by }}" {{ $sorting_by == request("sorting_by", 'id') ? 'selected' :'' }}>{{ $sorting_by }}</option>
        @endforeach
       </select>
      </div>
      <div class="col-md-6 mb-3">
       <label for="sorting_order">Sorting Order</label>
       <select name="sorting_order" id="sorting_order" class="form-control">
        <option value="asc" {{ request('sorting_order') == 'asc' ? 'selected' : '' }}>Asc</option>
        <option value="desc" {{ request('sorting_order') == 'desc' ? 'selected' : '' }}>Desc</option>
       </select>
      </div>
     </div>
     <button type="submit" class="btn btn-primary">Apply</button>
     <a href="{{ url("/products") }}" class="btn btn-outline-secondary">Reset</a>
    </form>
   </div>
   <table class="table table-bordered table-striped">
    <thead>
     <tr class="table-dark">
      <td>ID</td>
      <td>Image</td>
      <td>Name</td>
      <td>Category</td>
      <td>Price</td>
      <td>Created at</td>
     </tr>
    </thead>
    <tbody>
     @forelse ($products as $product)
      <tr>
       <td>{{ $product->id }}</td>
       <td>
        @if ($product->image)
            <img src="{{ $product->image }}" alt="product-{{ $product->id }}-image" class="rounded-circle" width="50" height="50">
        @endif
       </td>
       <td>{{ $product->name }}</td>
       <td><span class="badge bg-primary">{{ $product->category }}</span></td>
       <td>{{ Number::currency($product->price, 'EGP') }}</td>
       <td>{{ $product->created_at->diffForHumans() }}</td>
      </tr>
     @empty
         <tr>
          <td colspan="6" class="text-center text-muted">There are no products available!</td>
         </tr>
     @endforelse
    </tbody>
   </table>
   <div class="d-flex justify-content-center">{{ $products->links() }}</div>
  </div>
 </section>

 <script>
  function updateMinPrice(value){
   document.getElementById("min_price_span").textContent = value
  }
  function updateMaxPrice(value){
   document.getElementById("max_price_span").textContent = value
  }
 </script>
</body>
</html>