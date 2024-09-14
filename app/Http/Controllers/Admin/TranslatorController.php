<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTranslatorRequest;
use App\Http\Requests\UpdateTranslatorRequest;
use App\Models\EmailTranslator;
use App\Models\Translator;
use App\Services\SaveEmailDataServcie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class TranslatorController extends Controller
{
    public function __construct(private SaveEmailDataServcie $saveEmailDataServcie)
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $translators = Translator::orderBy('id' , 'desc')->paginate(10);
        return view('admin.translators.index' , ['translators' => $translators]);
    }

    public function create()
    {
        return view('admin.translators.create');
    }

    public function store(StoreTranslatorRequest $request)
    {
        $data = $request->validated();
        $dataFlatten = $request->only('emails' , 'phones');
        $dataChanged = $this->prepareArrayToSave($dataFlatten);

        $translator = new Translator();
        $translator->name = $data['name'];
        $translator->save();

        $this->saveEmailDataServcie->storeDataTranslators($dataChanged , $translator);
        return redirect()->route('translators.index');
    }

    public function edit($id)
    {
        $translator = Translator::find($id);
        $dateTranslators = EmailTranslator::where('translator_id' , $id)->get();
        return view('admin.translators.edit' , ['translator' => $translator , 'dateTranslators' => $dateTranslators]);
    }

    public function update(UpdateTranslatorRequest $request , Translator $translator)
    {
        $data =  $request->validated();
        $dataFlatten = $request->only('emails' , 'phones');
        $dataChanged = $this->prepareArrayToSave($dataFlatten);

        $translator->update($data);
        $this->saveEmailDataServcie->updateDataTranslators($dataChanged , $translator);
        return redirect()->route('translators.index');
    }

    public function destroy($id)
    {
        $this->saveEmailDataServcie->deleteDataTranslators($id);
        Translator::find($id)->delete();
        return redirect()->back();
    }

    private function prepareArrayToSave($arr)
    {
        $arr = array_map('array_values',$arr);
        $maxLength = 0;
        foreach($arr as $key=>$value){
            if(count($value)>$maxLength){
                $maxLength=count($value);
            }
        }

        $res =[];
        for($i = 0 ; $i < $maxLength ; $i++){
            $block = [];
            foreach($arr as $key=>$value){
                $block[Str::singular($key)]=$value[$i];
            }
            array_push($res,$block);
        }
        return $res;
    }
}
