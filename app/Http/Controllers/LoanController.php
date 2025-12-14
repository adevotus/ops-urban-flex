<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoanController extends Controller
{

    protected $sharedController;

    public function __construct(SharedController $sharedController){
        $this->sharedController = $sharedController;
    }
    public function loanDetails($loanNumber, $driverNumber){

        $response = $this->sharedController->loanDetailsByLoanNumber($loanNumber, $driverNumber);

        // Convert loanDetails to object
        $loanDetails = json_decode(json_encode($response['loanDetails'] ?? []));

        // Convert loanRepayments to collection of objects
        $loanRepayments = collect($response['loanRepayments'] ?? [])->map(function($item) {
            return json_decode(json_encode($item));
        });

        return view('manager.pages.components.loan_details', [
            'loanDetails' => $loanDetails,
            'loanRepayments' => $loanRepayments
        ]);


    }
}
