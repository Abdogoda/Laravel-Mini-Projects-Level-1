<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::paginate(10);
        return BrandResource::collection($brands);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBrandRequest $request)
    {
        $brand = Brand::create([
            'name' => $request->name
        ]);

        if($request->hasFile('image')){
            $file = $request->file("image");
            $filename = time(). '.' . $file->getClientOriginalExtension();

            $file->storeAs('uploaded/brands', $filename, 'public');
            
            $brand->image = $filename;
            $brand->save();
        }

        return response()->json([
            'message' => 'Brand Creatd Successfully',
            'brand' => new BrandResource($brand)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $brand = Brand::find($id);
        if($brand){
            return response()->json([
                'message' => 'Brand founded',
                'brand' => new BrandResource($brand)
            ]);
        }

        return response()->json([
            'message' => 'Brand not found!'
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBrandRequest $request, string $id)
    {
        $brand = Brand::find($id);
        if($brand){
            if($request->has('name')){
                $brand->name = $request->name;
            } 
            
            if($request->hasFile('image')){
                
                if($brand->image){
                    if(Storage::disk('public')->exists('uploaded/brands/'.$brand->image)){
                        Storage::disk('public')->delete('uploaded/brands/'.$brand->image);
                    }
                }
                
                $file = $request->file("image");
                $filename = time(). '.' . $file->getClientOriginalExtension();

                $file->storeAs('uploaded/brands', $filename, 'public');
                
                $brand->image = $filename;
            }
            $brand->save();

            return response()->json([
                'message' => 'Brand updated successfully',
                'brand' => new BrandResource($brand)
            ]);
        }

        return response()->json([
            'message' => 'Brand not found!'
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);
        if($brand){

            if($brand->image){
                if(Storage::disk('public')->exists('uploaded/brands/'.$brand->image)){
                    Storage::disk('public')->delete('uploaded/brands/'.$brand->image);
                }
            }

            $brand->delete();
            return response()->json([
                'message' => 'Brand deleted',
            ]);
        }

        return response()->json([
            'message' => 'Brand not found!'
        ], 404);
    }
}