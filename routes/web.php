<?php

use App\Http\Controllers\HelpDeskController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SSOLoginController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\AgreementController;
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

            Route::get('/dashboard/vehicle', [ManagerController::class, 'vehicleDashboard'])->name('dashboard.vehicle');

            Route::get('/dashboard/property', [ManagerController::class, 'propertyDashboard'])->name('dashboard.property');


            Route::get('/owner-list',[ManagerController::class,'ownerList'])->name('owner-list');
            Route::get('/owner-registration',[ManagerController::class,'ownerRegistration'])->name('owner-registration');

            Route::post('/owner-registration',[ManagerController::class,'ownerRegistrationStore'])->name('owner_registration_store');

             Route::get('/owner-vehicle-details/{ownerNumber}',[ManagerController::class,'ownerVehicleDetails'])->name('owner_details');

            Route::get('/vehicle-list',[ManagerController::class,'vehicleList'])->name('vehicle-list');

            Route::get('/driver-list',[ManagerController::class,'driverList'])->name('driver-list');
            Route::get('/client-driver-registration',[ManagerController::class,'driverRegistration'])->name('driver-registration');
            Route::post('/client-driver-registration',[ManagerController::class,'driverRegistrationStore'])->name('driver_registration_store');

            Route::get('/client-loan-list',[ManagerController::class,'loanList'])->name('loan-list');

            Route::get('/client-driver-loan-details/{loanNumber}/{driverNumber}',[LoanController::class,'loanDetails'])->name('client_driver_loan_details');

            Route::get('/client-agreement_list',[ManagerController::class,'agreementList'])->name('agreement-list');

            Route::get('/client-agreement-details/{agreementNumber}/{ownerNumber}',[AgreementController::class,'agreementDetails'])->name('client_agreement_details');

            Route::get('/client-transactions-list',[ManagerController::class,'ownerTransactionsList'])->name('owner_transactions_list');

            Route::get('/client-transactions-drive-history/{loanNumber}/{driverNumber}',[ManagerController::class,'ownerPaymentTransactionsDriverList'])->name('payment_transactions_driver_list');

           Route::get('/client-landlord-list',[ManagerController::class,'landLordList'])->name('landLord_list');
           Route::get('/client-landlord-register',[ManagerController::class,'landLordRegister'])->name('landLord_register');


        });

    Route::prefix('help')->name('help.')->middleware('role:HelpDesk')->group(function () {
        Route::get('/dashboard',[HelpDeskController::class,'index'])->name('dashboard');

        Route::get('/agreement-list',[HelpDeskController::class,'agreementList'])->name('agreement-list');

        Route::get('/vehicle-list',[HelpDeskController::class,'vehicleList'])->name('vehicle-list');

        Route::get('/loan-list',[HelpDeskController::class,'loanList'])->name('loan-list');

        Route::get('/driver-list',[HelpDeskController::class,'driverList'])->name('driver-list');

        Route::get('/owner-list',[HelpDeskController::class,'ownerList'])->name('owner-list');



    });



});

Route::get('/', function () {
    return view('welcome');
});
