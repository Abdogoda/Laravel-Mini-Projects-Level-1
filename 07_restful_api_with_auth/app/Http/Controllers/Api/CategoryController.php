<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return CategoryResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        if($request->hasFile('image')){
            $file = $request->file("image");
            $filename = time(). '.' . $file->getClientOriginalExtension();

            $file->storeAs('uploaded/categories', $filename, 'public');
            
            $category->image = $filename;
            $category->save();
        }

        return response()->json([
            'message' => 'Category Creatd Successfully',
            'category' => new CategoryResource($category)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::find($id);
        if($category){
            return response()->json([
                'message' => 'Category founded',
                'category' => new CategoryResource($category)
            ]);
        }

        return response()->json([
            'message' => 'Category not found!'
        ], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, string $id)
    {
        $category = Category::find($id);
        if($category){
            if($request->has('name')){
                $category->name = $request->name;
            } 
            if($request->has('description')){
                $category->description = $request->description;
            } 
            
            if($request->hasFile('image')){
                
                if($category->image){
                    if(Storage::disk('public')->exists('uploaded/categories/'.$category->image)){
                        Storage::disk('public')->delete('uploaded/categories/'.$category->image);
                    }
                }
                
                $file = $request->file("image");
                $filename = time(). '.' . $file->getClientOriginalExtension();

                $file->storeAs('uploaded/categories', $filename, 'public');
                
                $category->image = $filename;
            }
            $category->save();

            return response()->json([
                'message' => 'Category updated successfully',
                'category' => new CategoryResource($category)
            ]);
        }

        return response()->json([
            'message' => 'Category not found!'
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);
        if($category){

            if($category->image){
                if(Storage::disk('public')->exists('uploaded/categories/'.$category->image)){
                    Storage::disk('public')->delete('uploaded/categories/'.$category->image);
                }
            }

            $category->delete();
            return response()->json([
                'message' => 'Category deleted',
            ]);
        }

        return response()->json([
            'message' => 'Category not found!'
        ], 404);
    }
}