<?php

use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\WhyController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\ContactUserController;
use App\Http\Controllers\User\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('/' , [WebsiteController::class , 'index']);
Route::get('/about' , [WebsiteController::class , 'aboutUsPage']);
Route::get('/contact' , [WebsiteController::class , 'contactUsPage']);
Route::get('/show/service/{id}' , [WebsiteController::class , 'servicesPage']);
Route::post('/store/contact' , [ContactUserController::class , 'storeContact'])->name('store.contactUser');

Route::get('/admin/login', [AuthController::class , 'showLoginPage'])->name('login');
Route::post('/login', [AuthController::class , 'login'])->name('login.submit');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home' , [HomeController::class , 'home'])->name('home');

    Route::group(['prefix'=>'admin'], function(){
        Route::get('/settings' , [SettingController::class , 'index'])->name('settings.index');
        Route::get('/settings/{id}/edit' , [SettingController::class , 'edit'])->name('settings.edit');
        Route::post('/settings/{id}/update' , [SettingController::class , 'update'])->name('settings.update');

        Route::resource('services', ServiceController::class);
        Route::get('/services/delete/{id}' , [ServiceController::class , 'destroy']);

        Route::resource('why', WhyController::class);
        Route::get('/why/delete/{id}' , [WhyController::class , 'destroy']);

        Route::get('/contacts' , [ContactController::class , 'index'])->name('contact.index');
        Route::get('/contacts/{id}/show' , [ContactController::class , 'show'])->name('contact.show');
    });

    Route::get('/logout' , [AuthController::class , 'logout'])->name('logout');
});
