<?php

namespace App\Services;
use App\Models\CopyResetFile;
use Carbon\Carbon;


class CopyFileNamesService {

    public function storeDataFileCopyNames($fileNames , $reset)
    {
        $toInsert = [];
        foreach(json_decode($fileNames[0]) as $dataFiles){
            $temp['reset_file_copy_name'] = $dataFiles->reset_file_copy_name;
            $temp['number_copies'] = $dataFiles->number_copies;
            $temp['reset_id'] = $reset->id;
            $temp['created_at'] = Carbon::now();

            $toInsert[] = $temp;
        }
        CopyResetFile::insert($toInsert);
    }

    public function updateFileCopyNames($data , $reset)
    {
        try{
            CopyResetFile::where('reset_id' , $reset->id)->delete();
        }catch(\Exception $e){
            //do nothing
        }
        $toInsert = [];
        foreach(json_decode($data[0]) as $dataFiles){
            $temp['reset_file_copy_name'] = $dataFiles->reset_file_copy_name;
            $temp['number_copies'] = $dataFiles->number_copies;
            $temp['reset_id'] = $reset->id;
            $temp['created_at'] = Carbon::now();

            $toInsert[] = $temp;
        }
        CopyResetFile::insert($toInsert);

    }

    public function deleteDataCopyNames($id)
    {
        try{
            $fileNames = CopyResetFile::where('reset_id' , $id)->delete();
        }catch(\Exception $e){
            //do nothing
        }
    }
}
