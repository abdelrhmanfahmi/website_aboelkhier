<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\TranslatorMail;
use App\Models\EmailTranslator;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $translatorsEmails;
    public $recieveReset;

    public function __construct($translatorsEmails , $recieveReset)
    {
        $this->translatorsEmails = $translatorsEmails;
        $this->recieveReset = $recieveReset;
    }

    public function handle()
    {
        foreach($this->translatorsEmails as $translatorForSend){
            $emails = EmailTranslator::where('translator_id' , $translatorForSend)->pluck('email')->toArray();
            // $phones = EmailTranslator::where('translator_id' , $translatorForSend)->pluck('phone')->toArray();

            foreach($emails as $emailTranslator){
                \Mail::to($emailTranslator)->send(new TranslatorMail($this->recieveReset));
            }

            // foreach($phones as $phone){
            //     sendSmsMessages($phone,$recieveReset);
            // }
        }
    }

    public function failed(\Throwable $th)
    {
        info('this job is failed emails');
    }
}
