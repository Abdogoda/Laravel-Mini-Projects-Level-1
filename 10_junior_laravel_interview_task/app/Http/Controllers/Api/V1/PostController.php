<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    use ApiResponse;

    public function index(){
        $posts = Post::with(['tags'])->where('user_id', Auth::id())->orderBy('pinned', 'desc')->get();
        return $this->success('All posts', ['posts' => PostResource::collection($posts)]);
    }

    public function show(string $id){
        $post = Post::with(['user', 'tags'])->find($id);
        if(!$post || $post->user_id != Auth::id()){
            return $this->error('Post not found', 404);
        }

        return $this->success("Post found", ['post' => new PostResource($post)]);
    }

    public function store(StorePostRequest $request){
        $file = $request->file("image");
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $file->storeAs('uploaded/posts', $filename, 'public');

        $post = Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'image' => $filename,
            'pinned' => $request->pinned == 'true',
            'user_id' => Auth::id(),
        ]);
        $post->tags()->attach($request->tags);
        $post->load("tags");
        return $this->success("Post created successfully", ["post" => new PostResource($post)]);
    }

    public function update(UpdatePostRequest $request, string $id){
        $post = Post::find($id);
        if(!$post || $post->user_id != Auth::id()){
            return $this->error('Post not found', 404);
        }

        $data = $request->validated();
        $data['pinned'] = $request->pinned == 'true';

        if($request->hasFile('image')){
            if(Storage::disk('public')->exists('uploaded/posts/'.$post->image)){
                Storage::disk('public')->delete('uploaded/posts/'.$post->image);
            }

            $file = $request->file("image");
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('uploaded/posts', $filename, 'public');
            $data['image'] = $filename;
        }

        $post->update($data);
        $post->tags()->sync($request->tags);
        
        $post->load("user");
        return $this->success("Post updated successfully", ["post" => new PostResource($post)]);
    }

    public function destroy(string $id){
        $post = Post::find($id);
        if(!$post || $post->user_id != Auth::id()){
            return $this->error('Post not found', 404);
        }

        $post->delete();
        return $this->success("Post deleted successfully");
    }
    
    public function deleted(){
        $posts = Post::onlyTrashed()->where("user_id", Auth::id())->get();
        return $this->success('All deleted posts', ['posts' => PostResource::collection($posts)]);
    }

    public function restore(string $id){
        $post = Post::onlyTrashed()->find($id);
        if(!$post || $post->user_id != Auth::id()){
            return $this->error('Post not found', 404);
        }

        $post->restore();
        return $this->success("Post restored successfully");
    }
}