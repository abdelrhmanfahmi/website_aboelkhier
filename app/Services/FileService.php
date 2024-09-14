<?php

namespace App\Services;

use App\Jobs\SendFileService;
use App\Models\FileRecievedReset;

class FileService {

    public function storeFile($file)
    {
        try{
            $fileName = time().rand(1,99).'.'.$file->extension();
            $file->move(public_path('uploads'), $fileName);
            return $fileName;
        }catch(\Exception $e){
            return $e;
        }
    }

    public function storeFilesService($files , $recieveReset)
    {
        foreach($files as $file){
            $fileName = time().rand(1,99).'.'.$file->extension();
            $file->move(public_path('uploads'), $fileName);

            dispatch(new SendFileService($fileName , $recieveReset));
        }
    }

    public function updateFile($file , $model)
    {
        try{
            if($model->image == null){
                $fileName = time().rand(1,99).'.'.$file->extension();
                $file->move(public_path('uploads'), $fileName);
                return $fileName;
            }else{
                if($model){
                    unlink("uploads/".$model->image);
                }
                $fileName = time().rand(1,99).'.'.$file->extension();
                $file->move(public_path('uploads'), $fileName);
                return $fileName;
            }
        }catch(\Exception $e){
            return $e;
        }
    }

    public function deleteRecieveResetData($reset_id)
    {
        $files = FileRecievedReset::where('reset_id' , $reset_id)->get();
        try{
            foreach($files as $file){
                unlink("uploads/".$file->file);
                FileRecievedReset::where('reset_id' , $reset_id)->delete();
            }
        }catch(\Exception $e){
            //do nothing
        }
    }

}
