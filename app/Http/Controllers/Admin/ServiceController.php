<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceRequest;
use App\Http\Requests\UpdateServiceRequest;
use App\Models\Service;
use App\Services\FileService;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function __construct(private FileService $fileService)
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $services = Service::paginate(10);
        return view('admin.services.index' , compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreServiceRequest $request)
    {
        try{
            $data = $request->validated();
            if($request->has('image') && $request->image){
                $fileName = $this->fileService->storeFile($data['image']);
                $data['image'] = $fileName;
            }

            if($request->has('icon') && $request->icon){
                $fileName = $this->fileService->storeFile($data['icon']);
                $data['icon'] = $fileName;
            }

            Service::create($data);
            return redirect()->route('services.index');
        }catch(\Exception $e){
            return $e;
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $service = Service::find($id);
        return view('admin.services.edit' , compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateServiceRequest $request, string $id)
    {
        try{
            $data = $request->validated();
            $model = Service::find($id);
            if($request->has('image') && $request->image){
                $fileName = $this->fileService->updateFile($data['image'] , $model);
                $data['image'] = $fileName;
            }

            if($request->has('icon') && $request->icon){
                $fileName = $this->fileService->updateFile($data['icon'] , $model);
                $data['icon'] = $fileName;
            }

            Service::where('id' , $id)->update($data);
            return redirect()->route('services.index');
        }catch(\Exception $e){
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = Service::find($id);
        try{
            unlink("uploads/".$service->image);
            unlink("uploads/".$service->icon);
        }catch(\Exception $e){
            //do nothing
        }
        $service->delete();
        return redirect()->route('services.index');
    }
}
