<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FetchRandomUser{
    public function handle(): void{
        $response = Http::get('https://randomuser.me/api/');

        if($response->successful()){
            Log::info("Random user data: ", $response->json("results"));
        }else{
            Log::error('Faild to fetch random user data');
        }
    }
}