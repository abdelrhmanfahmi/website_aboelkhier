<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Log;

class FailedJob extends Command
{
    protected $signature = 'failedJob:cron';

    protected $description = 'Command description';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Artisan::call("queue:retry all");
        Log::info("Cron is Failed Job Work Fine!");
    }
}
