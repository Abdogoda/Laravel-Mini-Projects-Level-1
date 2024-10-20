<?php

use App\Jobs\DeleteOldPosts;
use App\Jobs\FetchRandomUser;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::job(new DeleteOldPosts)->daily();
Schedule::job(new FetchRandomUser)->everySixHours();