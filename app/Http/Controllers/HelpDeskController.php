<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HelpDeskController extends Controller
{

     protected  $sharedController;

    public function __construct(SharedController $sharedController){
        $this->sharedController = $sharedController;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function index(){

        return view('help.dashboard');
    }
    public function vehicleList(){

        $vehicleList = $this->sharedController->vehicleList();

        return view('help.pages.vehicleList',['vehicleList' => $vehicleList]);
    }

    public function agreementList(){

        $agreementList = $this->sharedController->agreementList();

        return view('help.pages.agreement_list',['agreementList'=> $agreementList]);
    }

    public function loanList(){

        $loanList = $this->sharedController->loanList();

        return view('help.pages.loan_list',['loanList'=>$loanList]);
    }

    public function driverList()
    {
        $driverList = $this->sharedController->driverList();

        $driverList = collect($driverList)->map(function ($driver) {
            if (isset($driver['additional_info']) && is_string($driver['additional_info'])) {$driver['additional_info'] = json_decode($driver['additional_info'], true);}
            return $driver;
        })->toArray();

        return view('help.pages.driver_list', compact('driverList'));
    }

    public function ownerList(){

        $ownerList = $this->sharedController->ownerList();

        return view('help.pages.owner_list',['ownerList'=>$ownerList]);

    }

}
