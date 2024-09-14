<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(auth()->user()->type == 'admin'){
            $users = User::all();
        }else{
            $users = User::whereHas('roles' , function($q){
                $q->where('name' , 'user')->orWhere('name' , 'revision');
            })->get();
        }

        return view('admin.users.index' , ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        try{
            $data = $request->validated();
            $user = User::create($data);
            if($user->type == 'admin'){
                $user->assignRole('admin');
            }elseif($user->type == 'user'){
                $user->assignRole('user');
            }else{
                $user->assignRole('revision');
            }
            return redirect()->route('users.index');
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
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.users.edit' , compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, $id)
    {
        try{
            $data = $request->validated();
            $user = User::find($id);
            if($request->has('password') && $request->password){
                $data['password'] = Hash::make($data['password']);
            }
            User::where('id' , $id)->update($data);
            if($request->has('type') && $request->type == 'admin'){
                $user->assignRole('admin');
            }elseif($request->has('type') && $request->type == 'admin'){
                $user->assignRole('user');
            }else{
                $user->assignRole('revision');
            }
            return redirect()->route('users.index');
        }catch(\Exception $e){
            return $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index');
    }
}
