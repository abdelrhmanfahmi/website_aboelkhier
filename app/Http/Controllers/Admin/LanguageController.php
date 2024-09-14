<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $languages = Language::orderBy('id' , 'desc')->paginate(10);
        return view('admin.languages.index' , ['languages' => $languages]);
    }

    public function create()
    {
        return view('admin.languages.create');
    }

    public function store(StoreLanguageRequest $request)
    {
        $data = $request->validated();
        Language::create($data);
        return redirect()->route('languages.index');
    }

    public function edit($id)
    {
        $language = Language::find($id);
        return view('admin.languages.edit' , ['language' => $language]);
    }

    public function update(UpdateLanguageRequest $request , Language $language)
    {
        $data =  $request->validated();
        $language->update($data);
        return redirect()->route('languages.index');
    }

    public function destroy($id)
    {
        Language::find($id)->delete();
        return redirect()->back();
    }
}
