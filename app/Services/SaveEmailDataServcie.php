<?php

namespace App\Services;
use App\Models\EmailTranslator;
use Carbon\Carbon;


class SaveEmailDataServcie {

    public function storeDataTranslators($data , $translator)
    {
        $toInsert = [];
        foreach($data as $dataEmails){
            $temp['email'] = $dataEmails['email'];
            $temp['phone'] = $dataEmails['phone'];
            $temp['translator_id'] = $translator->id;
            $temp['created_at'] = Carbon::now();

            $toInsert[] = $temp;
        }
        EmailTranslator::insert($toInsert);
    }

    public function updateDataTranslators($data , $translator)
    {
        $toInsert = [];
        try{
            $ifDeleted = EmailTranslator::where('translator_id' , $translator->id)->delete();
        }catch(\Exception $e){
            //do nothing
        }
        if($ifDeleted){
            foreach($data as $dataEmails){
                $temp['email'] = $dataEmails['email'];
                $temp['phone'] = $dataEmails['phone'];
                $temp['translator_id'] = $translator->id;
                $temp['created_at'] = Carbon::now();

                $toInsert[] = $temp;
            }
            EmailTranslator::insert($toInsert);
        }
    }

    public function deleteDataTranslators($translator)
    {
        try{
            EmailTranslator::where('translator_id' , $translator)->delete();
        }catch(\Exception $e){
            //do nothing
        }
    }
}
