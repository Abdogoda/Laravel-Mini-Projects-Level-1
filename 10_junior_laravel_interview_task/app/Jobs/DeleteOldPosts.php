<?php

namespace App\Jobs;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class DeleteOldPosts{

    public function handle(): void{
        Post::onlyTrashed()
            ->where('deleted_at', '<=', Carbon::now()->subDays(30))
            ->forceDelete();

        Log::info("All soft deleted posts more than 30 days are forcly deleted successfully");
    }
}