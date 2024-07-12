<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateSettingRequest;
use App\Repository\Interfaces\SettingRepositoryInterface;
use App\Services\FileService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function __construct(private FileService $fileService , private SettingRepositoryInterface $settingRepository)
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $count = Request()->count ?? 10;
        $paginate = Request()->paginate ?? true;

        $settings = $this->settingRepository->all($count , $paginate);
        return view('admin.settings.index' ,compact('settings'));
    }

    public function edit($id)
    {
        $setting = $this->settingRepository->find($id);
        return view('admin.settings.edit' , compact('setting'));
    }

    public function update(UpdateSettingRequest $request , $id)
    {
        try{
            $data = $request->validated();
            $model = $this->settingRepository->find($id);
            if($request->has('image') && $request->image){
                $fileName = $this->fileService->updateFile($data['image'] , $model);
                $data['image'] = $fileName;
            }
            $this->settingRepository->update($model , $data);
            return redirect()->route('settings.index');
        }catch(\Exception $e){
            return $e;
        }
    }
}
