<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Why;
use Illuminate\Http\Request;

class WebsiteController extends Controller
{
    public function index()
    {
        try{
            $settings = Setting::all();
            $services = Service::all();
            $why = Why::all();
            return view('website.home' , compact('settings' , 'services' , 'why'));
        }catch(\Exception $e){
            return $e;
        }
    }

    public function aboutUsPage()
    {
        try{
            $settings = Setting::all();
            return view('website.about' , compact('settings'));
        }catch(\Exception $e){
            return $e;
        }
    }

    public function contactUsPage()
    {
        try{
            return view('website.contact');
        }catch(\Exception $e){
            return $e;
        }
    }

    public function servicesPage($id)
    {
        try{
            $service = Service::find($id);
            return view('website.showService' , compact('service'));
        }catch(\Exception $e){
            return $e;
        }
    }
}
