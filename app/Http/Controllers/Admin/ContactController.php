<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try{
            $contacts = Contact::paginate(10);
            return view('admin.contacts.index' , compact('contacts'));
        }catch(\Exception $e){
            return $e;
        }
    }

    public function show($id)
    {
        $contact = Contact::find($id);
        return view('admin.contacts.show' , compact('contact'));
    }
}
