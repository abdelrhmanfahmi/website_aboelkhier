<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactUserController extends Controller
{
    public function storeContact(StoreContactRequest $request)
    {
        try{
            $data = $request->validated();
            Contact::create($data);
            return 1;
        }catch(\Exception $e){
            return $e;
        }
    }
}
