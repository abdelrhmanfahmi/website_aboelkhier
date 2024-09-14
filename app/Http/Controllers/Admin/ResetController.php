<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResetRequest;
use App\Http\Requests\UpdateResetRequest;
use App\Jobs\SendEmailJob;
use App\Models\CopyResetFile;
use App\Models\FileRecievedReset;
use App\Models\Language;
use App\Models\Reset;
use App\Models\ResetFileName;
use App\Models\ResetTranslator;
use App\Models\Translator;
use App\Models\User;
use App\Services\CopyFileNamesService;
use App\Services\FileNamesService;
use App\Services\FileService;
use Maatwebsite\Excel\Facades\Excel;
use App\Services\SaveTranslatorsReset;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ResetController extends Controller
{
    public function __construct(
        private FileService $fileService,
        private FileNamesService $fileNamesService,
        private CopyFileNamesService $copyFileNamesService,
        private SaveTranslatorsReset $saveTranslatorsReset
    )
    {
        $this->middleware('auth');
    }

    public function search(Request $request)
    {
        if($request->ajax() && $request->reset_number_id){
            $query = Reset::where('id' , $request->reset_number_id)->get();
            $returnHTML = view('admin.recieved_resets.rendered_data')->with('query', $query)->render();
            return response()->json(['html' => $returnHTML]);
        }

        if($request->ajax() && $request->reset_client_name){
            $query = Reset::where('reset_client' , 'LIKE' , '%'.$request->reset_client_name.'%')->get();
            $returnHTML = view('admin.recieved_resets.rendered_data')->with('query', $query)->render();
            return response()->json(['html' => $returnHTML]);
        }

        if($request->ajax() && $request->reset_client_phone){
            $query = Reset::where('reset_client_phone' , $request->reset_client_phone)->get();
            $returnHTML = view('admin.recieved_resets.rendered_data')->with('query', $query)->render();
            return response()->json(['html' => $returnHTML]);
        }

        if($request->ajax() && $request->reset_date){
            $query = Reset::whereDate('reset_date' , Carbon::parse($request->reset_date)->format('Y-m-d'))->get();
            $returnHTML = view('admin.recieved_resets.rendered_data')->with('query', $query)->render();
            return response()->json(['html' => $returnHTML]);
        }

        if($request->ajax() && $request->reset_recieved_date){
            $query = Reset::whereDate('reset_recieved_date' , Carbon::parse($request->reset_recieved_date)->format('Y-m-d'))->get();
            $returnHTML = view('admin.recieved_resets.rendered_data')->with('query', $query)->render();
            return response()->json(['html' => $returnHTML]);
        }

        if($request->ajax() && $request->client_code){
            $query = Reset::where('client_code' , $request->client_code)->get();
            $returnHTML = view('admin.recieved_resets.rendered_data')->with('query', $query)->render();
            return response()->json(['html' => $returnHTML]);
        }

        $query = Reset::where('is_revised' , '0')->orWhere('is_revised' , '2')->orWhere('is_revised' , '3')->orderBy('id' , 'DESC')->get();
        $returnHTML = view('admin.recieved_resets.rendered_data')->with('query', $query)->render();
        return response()->json(['html' => $returnHTML]);
    }

    public function searchDrafts(Request $request)
    {

        if($request->ajax() && $request->reset_number_id){
            $query = Reset::where('id' , $request->reset_number_id)->where('is_draft' , '0')->where('is_revised' , '0')->get();
            $returnHTML = view('admin.recieved_resets.rendered_draft')->with('query', $query)->render();
            return response()->json(['html' => $returnHTML]);
        }

        if($request->ajax() && $request->reset_client_name){
            $query = Reset::where('reset_client' , 'LIKE' , '%'.$request->reset_client_name.'%')->where('is_draft' , '0')->where('is_revised' , '0')->get();
            $returnHTML = view('admin.recieved_resets.rendered_draft')->with('query', $query)->render();
            return response()->json(['html' => $returnHTML]);
        }

        if($request->ajax() && $request->reset_client_phone){
            $query = Reset::where('reset_client_phone' , $request->reset_client_phone)->where('is_draft' , '0')->where('is_revised' , '0')->get();
            $returnHTML = view('admin.recieved_resets.rendered_draft')->with('query', $query)->render();
            return response()->json(['html' => $returnHTML]);
        }

        if($request->ajax() && $request->reset_date){
            $query = Reset::whereDate('reset_date' , Carbon::parse($request->reset_date)->format('Y-m-d'))
            ->where('is_draft' , '0')
            ->where('is_revised' , '0')
            ->get();
            $returnHTML = view('admin.recieved_resets.rendered_draft')->with('query', $query)->render();
            return response()->json(['html' => $returnHTML]);
        }

        if($request->ajax() && $request->reset_recieved_date){
            $query = Reset::whereDate('reset_recieved_date' , Carbon::parse($request->reset_recieved_date)->format('Y-m-d'))
            ->where('is_draft' , '0')
            ->where('is_revised' , '0')
            ->get();
            $returnHTML = view('admin.recieved_resets.rendered_draft')->with('query', $query)->render();
            return response()->json(['html' => $returnHTML]);
        }

        if($request->ajax() && $request->client_code){
            $query = Reset::where('client_code' , $request->client_code)->where('is_draft' , '0')->where('is_revised' , '0')->get();
            $returnHTML = view('admin.recieved_resets.rendered_draft')->with('query', $query)->render();
            return response()->json(['html' => $returnHTML]);
        }

        $returnHTML = view('admin.recieved_resets.rendered_draft')->render();
        return response()->json(['html' => 'no data posted']);

        $query = Reset::where('is_draft' , '0')->where('is_revised' , '0')->orderBy('id' , 'DESC')->get();
        $returnHTML = view('admin.recieved_resets.rendered_draft')->with('query', $query)->render();
        return response()->json(['html' => $returnHTML]);
    }

    public function drafts()
    {
        $resets = Reset::where('is_draft' , '0')->where('is_revised' , '0')->orderBy('id' , 'DESC')->paginate(10);
        return view('admin.resets.drafts' , ['resets' => $resets]);
    }

    public function trashedReset()
    {
        $resets = Reset::onlyTrashed()->get();
        return view('admin.resets.trashed' , ['resets' => $resets]);
    }

    public function index()
    {
        try{
            $resets = Reset::where('is_draft' , '1')->where('is_revised' , '0')->orWhere('is_revised' , '2')->orWhere('is_revised' , '3')->orderBy('id' , 'DESC')->paginate(10);
            return view('admin.resets.index' , ['resets' => $resets]);
        }catch(\Exception $e){
            return $e;
        }
    }

    public function create()
    {
        $languages = Language::all();
        $translators = Translator::all();
        $edit_users_id = User::all();
        return view('admin.resets.create' , ['edit_users_id' => $edit_users_id , 'languages' => $languages , 'translators' => $translators]);
    }

    public function store(StoreResetRequest $request)
    {
        try{
            DB::beginTransaction();
                $data = $request->validated();
                $data['user_id'] = auth()->user()->id;

                $translatorsForEmailers = $data['translators'];
                $translatorsEmails = explode(',', $translatorsForEmailers[0]);
                $data['translators'] = json_encode($data['translators']);

                $recieveReset = Reset::create($data);
                $this->fileNamesService->storeDataFileNames($data['reset_file_names'] , $recieveReset);

                if($request->has('copy_reset_files')){
                    $this->copyFileNamesService->storeDataFileCopyNames($data['copy_reset_files'] , $recieveReset);
                }

                if($request->hasFile('files') && $request->has('translators') && $request->edit_user_id != 'null'){
                    $this->saveTranslatorsReset->storeTranslatorsResets($data['translators'] , $recieveReset);
                    $this->fileService->storeFilesService($data['files'] , $recieveReset);

                    dispatch(new SendEmailJob($translatorsEmails , $recieveReset));

                    $recieveReset->update(['is_draft' => '1']);
                }else if($request->hasFile('files') && $request->has('translators') && $request->edit_user_id == 'null'){
                    $this->saveTranslatorsReset->storeTranslatorsResets($data['translators'] , $recieveReset);
                    $this->fileService->storeFilesService($data['files'] , $recieveReset);

                    dispatch(new SendEmailJob($translatorsEmails , $recieveReset));

                    $recieveReset->update(['is_draft' => '1']);
                }else{
                    $this->saveTranslatorsReset->storeTranslatorsResetsEmpty($recieveReset);
                }
            DB::commit();

            return $recieveReset;
        }catch(\Exception $e){
            return $e;
        }
    }

    public function edit($id)
    {
        $recieved_reset = Reset::where('id' , $id)->with('files_recieved_resets')->first();
        $languages = Language::all();
        $translators = Translator::all();
        $edit_users_id = User::all();
        $resetFiles = ResetFileName::where('reset_id' , $recieved_reset->id)->get();
        $resetFilesCopies = CopyResetFile::where('reset_id' , $recieved_reset->id)->get();
        return view('admin.resets.edit' , ['edit_users_id' => $edit_users_id , 'resetFilesCopies' => $resetFilesCopies , 'resetFiles' => $resetFiles , 'recieved_reset' => $recieved_reset , 'languages' => $languages , 'translators' => $translators]);
    }

    public function update(UpdateResetRequest $request , $id)
    {
        try{
            DB::beginTransaction();
                $data = $request->validated();
                $recieved_reset = Reset::find($id);

                $ifHasFiles = FileRecievedReset::where('reset_id' , $id)->get();

                $data['is_revised'] = '0';
                // $data['revised_by'] = null;

                $this->fileNamesService->updateFileNames($data['reset_file_names'] , $recieved_reset);
                $this->saveTranslatorsReset->updateTranslatorRecieved($data['translators'] , $recieved_reset);

                if($request->has('copy_reset_files')){
                    $this->copyFileNamesService->updateFileCopyNames($data['copy_reset_files'] , $recieved_reset);
                }

                $translatorsForEmailers = $data['translators'];
                $translatorsEmails = explode(',', $translatorsForEmailers[0]);
                $countTranslatorRequest = count($translatorsEmails);

                $countExistsTranslators = json_decode($recieved_reset->translators);
                $translatorData = explode(',', $countExistsTranslators[0]);
                $countExitsTranslatorsForComparison = count($translatorData);


                if($request->has('files') && ($countExitsTranslatorsForComparison != $countTranslatorRequest)){
                    // dd('test one');
                    $this->fileService->storeFilesService($data['files'] , $recieved_reset);
                    $isUpdated = $recieved_reset->update(['translator_notes' => $data['translator_notes']]);

                    if($isUpdated){
                        $translatorsForEmailers = $data['translators'];
                        $translatorsEmails = explode(',', $translatorsForEmailers[0]);
                        // $data['translators'] = json_encode($data['translators']);

                        dispatch(new SendEmailJob($translatorsEmails , $recieved_reset));
                    }
                    $data['is_draft'] = '1';
                }else if($request->has('files') && ($request->translators[0] != $translatorData[0])){
                    // dd('test two');
                    $this->fileService->storeFilesService($data['files'] , $recieved_reset);
                    $isUpdated = $recieved_reset->update(['translator_notes' => $data['translator_notes']]);

                    if($isUpdated){
                        $this->saveTranslatorsReset->updateTranslatorRecieved($data['translators'] , $recieved_reset);
                        $translatorsForEmailers = $data['translators'];
                        $translatorsEmails = explode(',', $translatorsForEmailers[0]);
                        // $data['translators'] = json_encode($data['translators']);

                        dispatch(new SendEmailJob($translatorsEmails , $recieved_reset));
                    }

                    $data['is_draft'] = '1';
                }else if($request->has('files') && ($countExitsTranslatorsForComparison == $countTranslatorRequest)){
                    // dd('test 3');
                    $this->fileService->storeFilesService($data['files'] , $recieved_reset);
                    $isUpdated = $recieved_reset->update(['translator_notes' => $data['translator_notes']]);

                    if($isUpdated){
                        $this->saveTranslatorsReset->updateTranslatorRecieved($data['translators'] , $recieved_reset);
                        $translatorsForEmailers = $data['translators'];
                        $translatorsEmails = explode(',', $translatorsForEmailers[0]);
                        // $data['translators'] = json_encode($data['translators']);

                        dispatch(new SendEmailJob($translatorsEmails , $recieved_reset));
                    }

                    $data['is_draft'] = '1';
                }else if((count($ifHasFiles) >= 1) && ($countExitsTranslatorsForComparison != $countTranslatorRequest)){
                    // dd('test 4');
                    $isUpdated = $recieved_reset->update(['translator_notes' => $data['translator_notes']]);

                    if($isUpdated){
                        $translatorsForEmailers = $data['translators'];
                        $translatorsEmails = explode(',', $translatorsForEmailers[0]);
                        // $data['translators'] = json_encode($data['translators']);

                        dispatch(new SendEmailJob($translatorsEmails , $recieved_reset));
                    }

                    $data['is_draft'] = '1';
                }else if($countTranslatorRequest == 1){
                    if((count($ifHasFiles) >= 1) && ($request->translators[0] != $translatorData[0])){
                        $isUpdated = $recieved_reset->update(['translator_notes' => $data['translator_notes']]);

                        if($isUpdated){
                            $translatorsForEmailers = $data['translators'];
                            $translatorsEmails = explode(',', $translatorsForEmailers[0]);
                            // $data['translators'] = json_encode($data['translators']);

                            dispatch(new SendEmailJob($translatorsEmails , $recieved_reset));
                        }

                        $data['is_draft'] = '1';
                    }

                }


                $recieved_reset->update($data);
            DB::commit();
            return 1;
        }catch(\Exception $e){
            return $e;
        }
    }

    public function destroy($id)
    {
        try{
            $this->fileService->deleteRecieveResetData($id);
            $this->fileNamesService->deleteDataNames($id);
            $this->copyFileNamesService->deleteDataCopyNames($id);
            $this->saveTranslatorsReset->deleteAllEmailResets($id);
            Reset::find($id)->delete();
        }catch(\Exception $e){
            return $e;
        }
    }

    public function indexRevisions()
    {
        try{

        }catch(\Exception $e){
            return $e;
        }
    }

    public function downloadImage($id)
    {
        $file = FileRecievedReset::find($id);
        $filepath = public_path('uploads/'.$file->file);
        return response()->download($filepath);
    }

    public function sendDataToRevision($id)
    {
        Reset::where('id' , $id)->update(['is_revised' => '1']);
        return 1;
    }

    public function copyReset($id)
    {
        $toInsert = [];
        $recievedDataCopy = Reset::where('id' , $id)->first();
        $recievedImageCopy = FileRecievedReset::where('reset_id' , $id)->get();
        $resetFileNames = ResetFileName::where('reset_id' , $id)->get();
        $dataTranslatorsResets = ResetTranslator::where('reset_id' , $id)->get();

        $dataCopiedNew = Reset::create([
            'reset_client' => $recievedDataCopy->reset_client,
            'reset_date' => Carbon::now(),
            'reset_client_phone' => $recievedDataCopy->reset_client_phone,
            'reset_client_phone_second' => $recievedDataCopy->reset_client_phone_second,
            'reset_translation' => $recievedDataCopy->reset_translation,
            'reset_where' => $recievedDataCopy->reset_where,
            'reset_for' => $recievedDataCopy->reset_for,
            'reset_pages_number' => $recievedDataCopy->reset_pages_number,
            'reset_name_english' => $recievedDataCopy->reset_name_english,
            'reset_total_cost' => $recievedDataCopy->reset_total_cost,
            'reset_cost_paid' => $recievedDataCopy->reset_cost_paid,
            'reset_cost_not_paid' => $recievedDataCopy->reset_cost_not_paid,
            'reset_recieved_date' => $recievedDataCopy->reset_recieved_date,
            'reset_notes' => $recievedDataCopy->reset_notes,
            'reset_notes_client' => $recievedDataCopy->reset_notes_client,
            'payment_type' => $recievedDataCopy->payment_type,
            'language_id' => $recievedDataCopy->language_id,
            'user_id' => $recievedDataCopy->user_id,
            'edit_user_id' => $recievedDataCopy->edit_user_id,
            'edit_user_id' => $recievedDataCopy->edit_user_id,
            'translators' => $recievedDataCopy->translators,
            'translator_notes' => $recievedDataCopy->translator_notes,
            'is_scan' => $recievedDataCopy->is_scan,
            'scan_price' => $recievedDataCopy->scan_price,
            'scan_payment_type' => $recievedDataCopy->scan_payment_type,
            'has_delivered' => $recievedDataCopy->has_delivered,
            'deliver_price' => $recievedDataCopy->deliver_price,
            'deliver_payment_type' => $recievedDataCopy->deliver_payment_type,
            'has_discount' => $recievedDataCopy->has_discount,
            'discount_price' => $recievedDataCopy->discount_price,
            'discount_desc' => $recievedDataCopy->discount_desc,
            'is_revised' => '0',
            'revised_by' => null,
            'recieved_by' => $recievedDataCopy->recieved_by,
            'recieved_by_name' => $recievedDataCopy->recieved_by_name,
            'recieved_by_phone' => $recievedDataCopy->recieved_by_phone,
            'is_draft' => $recievedDataCopy->is_draft
        ]);

        // foreach($recievedImageCopy as $image){
        //     $this->fileService->storeFilesService($image['files'] , $recievedDataCopy);
        // }

        foreach($resetFileNames as $resetFile){
            ResetFileName::create([
                'reset_file_name' => $resetFile->reset_file_name,
                'reset_file_original' => $resetFile->reset_file_original,
                'reset_id' => $dataCopiedNew->id
            ]);
        }

        foreach($dataTranslatorsResets as $dataTranslatorReset){
            ResetTranslator::create([
                'translator_id' => $dataTranslatorReset->translator_id,
                'reset_id' => $dataCopiedNew->id
            ]);
        }


        for($i = 0 ; $i < count($recievedImageCopy) ; $i++){
            $temp['file'] = 'fileCopy'.$recievedImageCopy[$i]->file;
            $temp['reset_id'] = $dataCopiedNew->id;
            $temp['created_at'] = Carbon::now();
            $temp['updated_at'] = Carbon::now();

            $sourceFilePath=public_path()."/uploads/".$recievedImageCopy[$i]->file;
            $destinationPath=public_path()."/uploads/". 'fileCopy'.$recievedImageCopy[$i]->file;
            $success = File::copy($sourceFilePath,$destinationPath);

            $toInsert[] = $temp;
        }
        FileRecievedReset::insert($toInsert);
        return 1;

    }

    public function showCopyFilesReset($id)
    {
        $copyResetFile = Reset::find($id);
        return view('admin.resets.copyResetFiles' , ['copyResetFile' => $copyResetFile]);
    }

    public function printReset($id)
    {
        $printedReset = Reset::find($id);
        $printedFileNames = ResetFileName::where('reset_id' , $id)->get();
        return view('admin.resets.print' , ['printedFileNames' => $printedFileNames , 'printedReset' => $printedReset]);
    }

    public function printResetCompany($id)
    {
        $printedReset = Reset::find($id);
        $printedFileNames = ResetFileName::where('reset_id' , $id)->get();
        return view('admin.resets.printCompany' , ['printedFileNames' => $printedFileNames , 'printedReset' => $printedReset]);
    }

    public function printForSystem($id)
    {
        $printedReset = Reset::find($id);
        $printedFileNames = ResetFileName::where('reset_id' , $id)->get();
        $copies = CopyResetFile::where('reset_id' , $id)->get();
        return view('admin.resets.printForSystem' , ['copies' => $copies , 'printedFileNames' => $printedFileNames , 'printedReset' => $printedReset]);
    }

    public function printResetRevision($id)
    {
        $printedReset = Reset::find($id);
        $printedFileNames = ResetFileName::where('reset_id' , $id)->get();
        return view('admin.resets.printInRevision' , ['printedFileNames' => $printedFileNames , 'printedReset' => $printedReset]);
    }

    public function printRevisionForSystem($id)
    {
        $printedReset = Reset::find($id);
        $printedFileNames = ResetFileName::where('reset_id' , $id)->get();
        $copies = CopyResetFile::where('reset_id' , $id)->get();
        return view('admin.resets.printInRevisionForSystem' , ['copies' => $copies , 'printedFileNames' => $printedFileNames , 'printedReset' => $printedReset]);
    }

    public function getPriceLanguage($languageId)
    {
        $languagePrice = Language::find($languageId);
        return response()->json($languagePrice->price);
    }

    public function showReason($id)
    {
        $reset = Reset::find($id);
        return view('admin.resets.showReason' , ['reset' => $reset]);
    }

    public function deleteSpecificImage($id)
    {
        $file = FileRecievedReset::find($id);
        try{
            unlink("uploads/".$file->file);
            $file->delete();
        }catch(\Exception $e){
            //do nothing
        }
        return 1;
    }

    // public function export()
    // {
    //     return Excel::download(new ResetExport, 'recieved_resets.xlsx');
    // }


    public function checkIfTimePayed($id)
    {
        $checkReset = Reset::find($id);
        return view('admin.resets.checkPayed' , ['checkReset' => $checkReset]);
    }

    public function checkPayedDate(Request $request , $id)
    {
        $resets = Reset::find($id);
        Reset::where('id' , $id)->update(['is_full_cost' => '0' , 'is_payed' => '1' , 'payment_type_two' => $request->payment_type_two , 'reset_recieved_date' => Carbon::now()->format('Y-m-d H:i:s') , 'date_full_payed' => Carbon::now()->format('Y-m-d H:i:s')]);
        if($resets->is_company == 1){
            return redirect('resets/'.$id.'/printForCompany');
        }else{
            return redirect('resets/'.$id.'/print');
        }
    }

    public function checkIfTimePayedRevision($id)
    {
        $checkReset = Reset::find($id);
        return view('admin.resets.checkPayedRevision' , ['checkReset' => $checkReset]);
    }

    public function checkPayedDateRevision(Request $request , $id)
    {
        $resets = Reset::find($id);
        Reset::where('id' , $id)->update(['is_full_cost' => '0' , 'is_payed' => '1' , 'payment_type_two' => $request->payment_type_two , 'reset_recieved_date' => Carbon::now()->format('Y-m-d H:i:s') , 'date_full_payed' => Carbon::now()->format('Y-m-d H:i:s')]);
        return redirect('resets/'.$id.'/printRevision');
    }
}
