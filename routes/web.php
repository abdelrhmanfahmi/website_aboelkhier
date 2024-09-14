<?php

use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\ResetController;
use App\Http\Controllers\Admin\RevisionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\TranslatorController;
use App\Http\Controllers\Admin\WhyController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\ContactUserController;
use App\Http\Controllers\User\WebsiteController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/' , [WebsiteController::class , 'index']);
Route::get('/about' , [WebsiteController::class , 'aboutUsPage']);
Route::get('/contact' , [WebsiteController::class , 'contactUsPage']);
Route::get('/show/service/{id}' , [WebsiteController::class , 'servicesPage']);
Route::post('/store/contact' , [ContactUserController::class , 'storeContact'])->name('store.contactUser');


Route::get('admin' , function(){
    return redirect()->route('login');
});
Route::get('/admin/login', [AuthController::class , 'showLoginPage'])->name('login');
Route::post('/login', [AuthController::class , 'login'])->name('login.submit');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home' , [HomeController::class , 'home'])->name('home');
    Route::get('/get/price/language/{id}' , [ResetController::class , 'getPriceLanguage']);
    // Route::group(['prefix'=>'admin'], function(){
        Route::get('/settings' , [SettingController::class , 'index'])->name('settings.index');
        Route::get('/settings/{id}/edit' , [SettingController::class , 'edit'])->name('settings.edit');
        Route::post('/settings/{id}/update' , [SettingController::class , 'update'])->name('settings.update');

        Route::resource('services', ServiceController::class);
        Route::get('/services/delete/{id}' , [ServiceController::class , 'destroy']);

        Route::resource('why', WhyController::class);
        Route::get('/why/delete/{id}' , [WhyController::class , 'destroy']);

        Route::get('/contacts' , [ContactController::class , 'index'])->name('contact.index');
        Route::get('/contacts/{id}/show' , [ContactController::class , 'show'])->name('contact.show');


        //admin dashboard
        Route::resource('users' , UserController::class);
        Route::resource('languages' , LanguageController::class);
        Route::resource('translators' , TranslatorController::class);
        Route::resource('resets', ResetController::class)->except(['store' , 'update']);

        Route::get('/resets/{id}/printRevision' , [ResetController::class , 'printResetRevision'])->name('print.resetRevision');
        Route::get('/resets/{id}/printRevisionForSystem' , [ResetController::class , 'printRevisionForSystem'])->name('print.resetRevisionForSystem');
        Route::get('/trashed/resets' , [ResetController::class , 'trashedReset'])->name('trashed.resets');
        Route::get('/revision/reset' , [ResetController::class , 'indexRevisions']);
        Route::get('/reset/check/payed/{id}' , [ResetController::class , 'checkIfTimePayed']);
        Route::post('/reset/checkPayed/{id}' , [ResetController::class , 'checkPayedDate'])->name('reset.checkPayedDate');
        Route::get('/reset/check/payed/revision/{id}' , [ResetController::class , 'checkIfTimePayedRevision']);
        Route::post('/reset/checkPayed/revision/{id}' , [ResetController::class , 'checkPayedDateRevision'])->name('reset.checkPayedDateRevision');

        Route::post('/store/recieved/reset' , [ResetController::class , 'store']);
        Route::post('/update/recieved/reset/{id}' , [ResetController::class , 'update']);
        Route::get('/delete/exist/image/{id}' , [ResetController::class , 'deleteSpecificImage']);
        Route::get('/copy/resets/{id}' , [ResetController::class , 'copyReset']);
        Route::get('/showCopyFilesReset/{id}' , [ResetController::class , 'showCopyFilesReset']);
        Route::post('/copy/files/reset' , [ResetController::class , 'copyFilesFromReset'])->name('reset.copyFilesFromReset');
        Route::get('/drafts' , [ResetController::class , 'drafts'])->name('drafts');
        Route::post('/search' , [ResetController::class , 'search'])->name('search');
        Route::post('/search/draft' , [ResetController::class , 'searchDrafts'])->name('search.draft');
        Route::get('/excel/export/recieved_resets' , [ResetController::class , 'export']);
        Route::get('/send/revision/{id}' , [ResetController::class , 'sendDataToRevision']);
        Route::get('/show/reset/reason/{id}' , [ResetController::class , 'showReason'])->name('show.reason');
        Route::get('/resets/{id}/print' , [ResetController::class , 'printReset'])->name('print.reset');
        Route::get('/resets/{id}/printForSystem' , [ResetController::class , 'printForSystem'])->name('print.resetForSystem');
        Route::get('/resets/{id}/printForCompany' , [ResetController::class , 'printResetCompany'])->name('printCompany.reset');

        Route::get('/revisions/resets' , [RevisionController::class , 'indexRevisionsResets'])->name('revisions.index');
        Route::get('/show/revise/page/{id}' , [RevisionController::class , 'showRevisePage']);
        Route::get('/resets/{id}/revise' , [RevisionController::class , 'revise'])->name('recieved_resets.revise');
        Route::post('/resets/{id}/revert' , [RevisionController::class , 'revert'])->name('recieved_resets.revert');
        Route::post('/search/revision' , [RevisionController::class , 'searchRevision'])->name('search.revision');
    // });

    Route::get('/logout' , [AuthController::class , 'logout'])->name('logout');
});
