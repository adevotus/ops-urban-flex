<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class PaymentController extends Controller{

    protected $sharedController;

    public function __construct(SharedController $sharedController){
        $this->sharedController = $sharedController;
    }
    public function getOwnerPaymentList(){

    }
}
