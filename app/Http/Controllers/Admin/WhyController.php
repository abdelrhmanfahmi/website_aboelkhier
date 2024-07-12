<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWhyRequest;
use App\Http\Requests\UpdateWhyRequest;
use App\Models\Why;
use App\Services\FileService;
use Illuminate\Http\Request;

class WhyController extends Controller
{
    public function __construct(private FileService $fileService)
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $why = Why::paginate(10);
        return view('admin.why.index' , compact('why'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.why.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreWhyRequest $request)
    {
        try{
            $data = $request->validated();
            if($request->has('image') && $request->image){
                $fileName = $this->fileService->storeFile($data['image']);
                $data['image'] = $fileName;
            }
            Why::create($data);
            return redirect()->route('why.index');
        }catch(\Exception $e){
            return $e;
        }
    }

    /**
     * Display the specified resource.
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
        $why = Why::find($id);
        return view('admin.why.edit' , compact('why'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateWhyRequest $request, string $id)
    {
        try{
            $data = $request->validated();
            $model = Why::find($id);

            if($request->has('image') && $request->image){
                $fileName = $this->fileService->updateFile($data['image'] , $model);
                $data['image'] = $fileName;
            }

            Why::where('id' , $id)->update($data);
            return redirect()->route('why.index');
        }catch(\Exception $e){
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $why = Why::find($id);
        try{
            unlink("uploads/".$why->image);
            unlink("uploads/".$why->icon);
        }catch(\Exception $e){
            //do nothing
        }
        $why->delete();
        return redirect()->route('why.index');
    }
}
