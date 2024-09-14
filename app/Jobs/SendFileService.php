<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\FileRecievedReset;
use Carbon\Carbon;

class SendFileService implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $file;
    public $recieveReset;

    public function __construct($file , $recieveReset)
    {
        $this->file = $file;
        $this->recieveReset = $recieveReset;
    }


    public function handle()
    {
        FileRecievedReset::create([
            'file' => $this->file,
            'reset_id' => $this->recieveReset->id,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }

    public function failed(\Throwable $th)
    {
        info('this job is failed files resets');
    }
}
