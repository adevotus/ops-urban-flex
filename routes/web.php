<?php

use App\Http\Controllers\HelpDeskController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SSOLoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/sso-login',[SSOLoginController::class,'ssoLogin'])->name('sso-login');


Route::middleware('check.sso')->group(function () {
    Route::post('/logout',[SSOLoginController::class,'ssoLogout'])->name('logout');


    Route::prefix('manager')->name('manager.')->middleware('role:Manager')
        ->group(function () {
            Route::get('/dashboard',[ManagerController::class,'index'])->name('dashboard');

            Route::get('/owner-list',[ManagerController::class,'ownerList'])->name('owner-list');
            Route::get('/owner-registration',[ManagerController::class,'ownerRegistration'])->name('owner-registration');
            Route::post('/owner-registration',[ManagerController::class,'ownerRegistrationStore'])->name('owner_registration_store');

        });

    Route::prefix('help')->name('help.')->middleware('role:HelpDesk')->group(function () {
        Route::get('/dashboard',[HelpDeskController::class,'index'])->name('dashboard');
        Route::get('/vehicle-list',[HelpDeskController::class,'vehicleList'])->name('vehicle-list');

    });



});
