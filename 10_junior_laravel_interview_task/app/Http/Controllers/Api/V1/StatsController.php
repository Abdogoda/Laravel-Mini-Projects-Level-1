<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class StatsController extends Controller{

    use ApiResponse;

    public function __invoke(){
        $stats = Cache::remember('user_post_stats', 60*60*24, function () {
            $data = [];
            $data['users_count'] = User::count();
            $data['posts_count'] = Post::count();
            $data['users_with_no_posts'] = User::doesntHave('posts')->count();
            return $data;
        });


        return $this->success("All Stats", ['stats' => $stats]);
    }
}