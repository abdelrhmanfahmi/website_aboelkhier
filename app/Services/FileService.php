<?php

namespace App\Services;

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

}
