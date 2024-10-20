<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\GetProductRequest;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(GetProductRequest $request)
    {
        $query = Product::query();

        // with eager loaded
        $with_array = [];
        if($request->has('with_category')) $with_array[] = 'category';
        if($request->has('with_brand')) $with_array[] = 'brand';
        if($request->has('with_user')) $with_array[] = 'user';

        // search
        if($request->filled('search')) $query->where("name", 'like', '%'.$request->search.'%');

        // filter by category
        if($request->filled('category_id')) $query->where("category_id", $request->category_id);

        // filter by price
        if($request->filled('min_price') || $request->filled('max_price')){
            $query->whereBetween("price", [$request->get("min_price", 0), $request->get("max_price", 10000)]);
        } 

        // sorting by (name, price, data)
        $sorting_by = $request->get("sort_by", 'id');
        $sorting_order = $request->get("sort_order", 'asc');
        $query->orderBy($sorting_by, $sorting_order);

        // per page
        $per_page = $request->get("per_page", 10);


        $products = $query->with($with_array)->paginate($per_page)->appends($request->query());
        
        return ProductResource::collection($products);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request)
    {
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'user_id' => Auth::id(),
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
        ];
        
        if($request->hasFile('image')){
            $file = $request->file("image");
            $filename = time(). '.' . $file->getClientOriginalExtension();

            $file->storeAs('uploaded/products', $filename, 'public');
            
            $data['image'] = $filename;
        }

        $product = Product::create($data);

        return response()->json([
            'message' => 'Product Creatd Successfully',
            'product' => new ProductResource($product)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::find($id);
        if($product){
            return response()->json([
                'message' => 'Product founded',
                'product' => new ProductResource($product)
            ]);
        }

        return response()->json([
            'message' => 'Product not found!'
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $product = Product::find($id);
        if($product){

            if(!Gate::allows('update', $product)){
                return response()->json([
                    'message' => 'Not allowed!'
                ], 403);
            }

            if($request->has('name')){
                $product->name = $request->name;
            } 
            if($request->has('description')){
                $product->description = $request->description;
            } 
            if($request->has('price')){
                $product->price = $request->price;
            } 
            if($request->has('category_id')){
                $product->category_id = $request->category_id;
            } 
            if($request->has('brand_id')){
                $product->brand_id = $request->brand_id;
            } 
            
            if($request->hasFile('image')){
                
                if($product->image){
                    if(Storage::disk('public')->exists('uploaded/products/'.$product->image)){
                        Storage::disk('public')->delete('uploaded/products/'.$product->image);
                    }
                }
                
                $file = $request->file("image");
                $filename = time(). '.' . $file->getClientOriginalExtension();

                $file->storeAs('uploaded/products', $filename, 'public');
                
                $product->image = $filename;
            }
            $product->save();

            return response()->json([
                'message' => 'Product updated successfully',
                'product' => new ProductResource($product)
            ]);
        }

        return response()->json([
            'message' => 'Product not found!'
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id);
        if($product){
            
            Gate::authorize('delete', $product);

            if($product->image){
                if(Storage::disk('public')->exists('uploaded/products/'.$product->image)){
                    Storage::disk('public')->delete('uploaded/products/'.$product->image);
                }
            }

            $product->delete();
            return response()->json([
                'message' => 'Product deleted',
            ]);
        }

        return response()->json([
            'message' => 'Product not found!'
        ], 404);
    }

    public function delete(string $id){
        $product = Product::find($id);
    }
}