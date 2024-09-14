<?php

namespace App\Services;
use App\Models\ResetTranslator;
use App\Models\EmailTranslator;
use App\Mail\TranslatorMail;
use Carbon\Carbon;

class SaveTranslatorsReset {

    public function storeTranslatorsResets($translators , $reset)
    {
        $dataTransformed = json_decode($translators);
        $translatorsForLoop = explode(',', $dataTransformed[0]);
        $toInsert = [];
        foreach($translatorsForLoop as $translator){
            $temp['translator_id'] = $translator;
            $temp['reset_id'] = $reset->id;
            $toInsert [] = $temp;
        }

        ResetTranslator::insert($toInsert);
    }

    public function storeTranslatorsResetsEmpty($reset)
    {
        ResetTranslator::create([
            'reset_id' => $reset->id
        ]);
    }

    public function updateTranslatorRecieved($data , $reset)
    {
        $translatorsForLoop = explode(',', $data[0]);
        try{
            $ifDeleted = ResetTranslator::where('reset_id' , $reset->id)->delete();
        }catch(\Exception $e){
            //do nothing
        }
        $toInsert = [];
        if($ifDeleted){
            foreach($translatorsForLoop as $dataFiles){
                $temp['translator_id'] = $dataFiles;
                $temp['reset_id'] = $reset->id;
                $temp['created_at'] = Carbon::now();

                $toInsert[] = $temp;
            }
            ResetTranslator::insert($toInsert);
        }
    }

    public function deleteAllEmailResets($id)
    {
        try{
            $translatorsRests = ResetTranslator::where('reset_id' , $id)->delete();
        }catch(\Exception $e){
            //do nothing
        }
    }

}
