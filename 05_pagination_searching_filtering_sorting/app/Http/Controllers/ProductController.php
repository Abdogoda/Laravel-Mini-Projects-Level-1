<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request){
        $query = Product::query();

        if($request->has("search") && $request->search != ''){
            $query->where("name", 'like', '%'.$request->search.'%');
        }

        if($request->has("category") && $request->category != '' && $request->category != 'all'){
            $query->where("category", $request->category);
        }

        if($request->has("min_price") || $request->has("max_price")){
            $query->whereBetween("price", [$request->get("min_price", 0), $request->get("max_price", 10000)]);
        }

        if($request->has("sorting_by")){
            $sorting_order = $request->get("sorting_order", 'asc');
            $query->orderBy($request->sorting_by, $sorting_order);
        }

        $products = $query->paginate(10)->appends($request->query());
        
        return view("products.index", compact("products"));
    }
}