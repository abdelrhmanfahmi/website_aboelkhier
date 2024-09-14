<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CopyResetFile;
use App\Models\Language;
use App\Models\Reset;
use App\Models\ResetFileName;
use App\Models\Translator;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RevisionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function searchRevision(Request $request)
    {
        if($request->ajax() && $request->reset_number_id){
            $query = Reset::where('id' , $request->reset_number_id)->get();
            $returnHTML = view('admin.admin.revisions.rendered_data')->with('query', $query)->render();
            return response()->json(['html' => $returnHTML]);
        }

        if($request->ajax() && $request->reset_client_name){
            $query = Reset::where('reset_client' , 'LIKE' , '%'.$request->reset_client_name.'%')->get();
            $returnHTML = view('admin.revisions.rendered_data')->with('query', $query)->render();
            return response()->json(['html' => $returnHTML]);
        }

        if($request->ajax() && $request->reset_client_phone){
            $query = Reset::where('reset_client_phone' , $request->reset_client_phone)->get();
            $returnHTML = view('admin.revisions.rendered_data')->with('query', $query)->render();
            return response()->json(['html' => $returnHTML]);
        }

        if($request->ajax() && $request->reset_date){
            $query = Reset::whereDate('reset_date' , Carbon::parse($request->reset_date)->format('Y-m-d'))->get();
            $returnHTML = view('admin.revisions.rendered_data')->with('query', $query)->render();
            return response()->json(['html' => $returnHTML]);
        }

        if($request->ajax() && $request->reset_recieved_date){
            $query = Reset::whereDate('reset_recieved_date' , Carbon::parse($request->reset_recieved_date)->format('Y-m-d'))->get();
            $returnHTML = view('admin.revisions.rendered_data')->with('query', $query)->render();
            return response()->json(['html' => $returnHTML]);
        }

        $query = Reset::where('is_revised' , '0')->orWhere('is_revised' , '1')->orWhere('is_revised' , '2')->orWhere('is_revised' , '3')->orderBy('id' , 'DESC')->get();
        $returnHTML = view('admin.revisions.rendered_data')->with('query', $query)->render();
        return response()->json(['html' => $returnHTML]);
    }

    public function indexRevisionsResets()
    {
        $recieved_resets = Reset::where('is_revised' , '1')->where('is_draft' , '1')->orderBy('id' , 'DESC')->paginate(10);
        return view('admin.revisions.index' , ['recieved_resets' => $recieved_resets]);
    }

    public function showRevisePage($id)
    {
        $recieved_reset = Reset::where('id' , $id)->with('files_recieved_resets')->first();
        $resetFiles = ResetFileName::where('reset_id' , $id)->get();
        $languages = Language::all();
        $translators = Translator::all();
        $edit_users_id = User::all();
        $resetFilesCopies = CopyResetFile::where('reset_id' , $recieved_reset->id)->get();
        return view('admin.revisions.revise' , ['resetFilesCopies' => $resetFilesCopies , 'edit_users_id' => $edit_users_id , 'resetFiles' => $resetFiles , 'recieved_reset' => $recieved_reset , 'languages' => $languages , 'translators' => $translators]);
    }

    public function revise($id)
    {
        Reset::where('id' , $id)->update(['is_revised' => '2' , 'revised_by' => auth()->user()->id]);
        return 1;
    }

    public function revert(Request $request , $id)
    {
        Reset::where('id' , $id)->update(['revert_reason' => $request->revert_reason , 'is_revised' => '3' , 'revised_by' => auth()->user()->id]);
        return 1;
    }
}
