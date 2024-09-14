<?php

namespace App\Services;
use App\Models\ResetFileName;
use Carbon\Carbon;


class FileNamesService {

    public function storeDataFileNames($fileNames , $reset)
    {
        $toInsert = [];
        foreach(json_decode($fileNames[0]) as $dataFiles){
            $temp['reset_file_name'] = $dataFiles->reset_file_name;
            $temp['reset_file_original'] = $dataFiles->reset_file_original;
            $temp['reset_id'] = $reset->id;
            $temp['created_at'] = Carbon::now();

            $toInsert[] = $temp;
        }
        ResetFileName::insert($toInsert);
    }

    public function updateFileNames($data , $reset)
    {
        try{
            $ifDeleted = ResetFileName::where('reset_id' , $reset->id)->delete();
        }catch(\Exception $e){
            //do nothing
        }
        $toInsert = [];
        if($ifDeleted){
            foreach(json_decode($data[0]) as $dataFiles){
                $temp['reset_file_name'] = $dataFiles->reset_file_name;
                $temp['reset_file_original'] = $dataFiles->reset_file_original;
                $temp['reset_id'] = $reset->id;
                $temp['created_at'] = Carbon::now();

                $toInsert[] = $temp;
            }
            ResetFileName::insert($toInsert);
        }
    }

    public function deleteDataNames($id)
    {
        try{
            $fileNames = ResetFileName::where('reset_id' , $id)->delete();
        }catch(\Exception $e){
            //do nothing
        }
    }
}
