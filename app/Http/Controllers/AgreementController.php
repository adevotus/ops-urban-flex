<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class AgreementController extends Controller{
    protected $sharedController;

    public function __construct(SharedController $sharedController){
        $this->sharedController = $sharedController;
    }

    public function agreementDetails($agreementNumber,$ownerNumber){

        $response = $this->sharedController->agreementDetailsByAgreementNumber($agreementNumber,$ownerNumber);
        // Convert loanDetails to object
        $agreement = json_decode(json_encode($response ?? []));

        return view('manager.pages.components.agreement_details', [
            'agreement' => $agreement,
        ]);
    }
}
