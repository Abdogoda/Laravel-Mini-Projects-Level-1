<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class TagController extends Controller{
    use ApiResponse; // trait for api responses
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::all();
        return $this->success('All tags', ["tags" => TagResource::collection($tags)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTagRequest $request)
    {
        $tag = Tag::create(['name' => $request->name]);

        return $this->success('Tag created successfully', ["tag" => new TagResource($tag)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTagRequest $request, string $id)
    {
        $tag = Tag::find($id);
        if(!$tag){
            return $this->error("Tag not found", 404);
        }
        
        $tag->update(['name' => $request->name]);
        return $this->success('Tag updated successfully', ["tag" => new TagResource($tag)]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tag = Tag::find($id);
        if(!$tag){
            return $this->error("Tag not found", 404);
        }
        
        $tag->delete();
        return $this->success('Tag deleted successfully');
    }
}