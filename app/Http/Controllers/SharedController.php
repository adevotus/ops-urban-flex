<?php

namespace App\Http\Controllers;

use App\Dto\JsonResponse;
use App\Util\LoggerUtil;
use Illuminate\Support\Facades\Http;

class SharedController extends Controller{


    protected $clientHost;
    protected $endPointToken;

    protected $authHost;

    public function __construct( ){
        $this->clientHost = config('app.client_host');
        $this->endPointToken=config('app.jwt_end_point_token');
        $this->authHost = config('app.auth_host');


    }

  public function ownersSummaryCounts()
    {
        try {
            $response = Http::withToken($this->endPointToken) ->get($this->clientHost . '/api/v1/external/summary');

            LoggerUtil::info("Owner summary response: " . $response->body());

            if (!$response->successful()) {
                LoggerUtil::warning("HTTP request failed", [ 'status' => $response->status()  ]);

                return [];
            }

             $res = $response->json();

            if (($res['status'] ?? null) !== 200) {
                LoggerUtil::warning("API returned failure", $res);
                return [];
            }

            return $res['Data'] ?? [];

        } catch (\Exception $e) {
            LoggerUtil::error("Error fetching owner summary: " . $e->getMessage());
            return [];
        }
    }


    public function vehicleList(){

        try {
            // Call API
            $response = Http::withToken($this->endPointToken)->get($this->clientHost . '/api/v1/vehicle/list');

            LoggerUtil::info("Vehicle list API RAW Response: " . $response->body());

            $res = $response->json();

            if ($response->status() !== 200 || ($res['status'] ?? null) !== "200") {

                LoggerUtil::warning("Failed to fetch owner list. Response: " . json_encode($res));

                return JsonResponse::get('500', 'Failed to retrieve vehicle.', '');

            }

            return $res['Data'] ?? [];

        } catch (\Exception $e) {

            LoggerUtil::error("Error fetching vehicle list: " . $e->getMessage());
            return JsonResponse::get('500', 'Failed to retrieve vehicle.', '');
        }

    }


    public function driverList(){

        try {
            // Call API
            $response = Http::withToken($this->endPointToken)->get($this->clientHost . '/api/v1/driver/list');

            LoggerUtil::info("Driver list API RAW Response: " . $response->body());

            $res = $response->json();

            if ($response->status() !== 200 || ($res['status'] ?? null) !== "200") {

                LoggerUtil::warning("Failed to fetch owner list. Response: " . json_encode($res));

                return JsonResponse::get('500', 'Failed to retrieve  driver list.', '');
            }

            return $res['Data'] ?? [];

        } catch (\Exception $e) {

            LoggerUtil::error("Error fetching driver list: " . $e->getMessage());

            return JsonResponse::get('500', 'Failed to retrieve driver list.', '');
        }

    }


    public  function loanList(){
        try {

            $response = Http::withToken($this->endPointToken)->get($this->clientHost . '/api/v1/loan/list');

            LoggerUtil::info("Driver list API RAW Response: " . $response->body());

            $res = $response->json();

            if ($response->status() !== 200 || ($res['status'] ?? null) !== "200") {

                LoggerUtil::warning("Failed to fetch loans list. Response: " . json_encode($res));

                return JsonResponse::get('500', 'Failed to retrieve loans list.', '');
            }

            return $res['Data'] ?? [];

        } catch (\Exception $e) {

            LoggerUtil::error("Error fetching driver list: " . $e->getMessage());

            return JsonResponse::get('500', 'Failed to retrieve loans list.', '');
        }
    }


    public function agreementList(){
        try {
            // Call API
            $response = Http::withToken($this->endPointToken)->get($this->clientHost . '/api/v1/agreement/list');

            LoggerUtil::info("Driver list API RAW Response: " . $response->body());

            $res = $response->json();

            if ($response->status() !== 200 || ($res['status'] ?? null) !== "200") {

                LoggerUtil::warning("Failed to fetch agreement list. Response: " . json_encode($res));

                return JsonResponse::get('500', 'Failed to retrieve agreement list.', '');
            }

            return  $res['Data'] ?? [];

        } catch (\Exception $e) {

            LoggerUtil::error("Error fetching driver list: " . $e->getMessage());

            return JsonResponse::get('500', 'Failed to retrieve agreement list.', '');
        }
    }


    public function ownerList()
    {
        try {
            // Call API
            $response = Http::withToken($this->endPointToken)->get($this->authHost . '/api/v1/users/owner');

            LoggerUtil::info("Owner List API RAW Response: " . $response->body());

            $res = $response->json();

            if ($response->status() !== 200 || ($res['status'] ?? null) !== "200") {

                LoggerUtil::warning("Failed to fetch owner list. Response: " . json_encode($res));

                return JsonResponse::get('500', 'Failed to retrieve owner list.', '');
            }

            return $res['Data'] ?? [];

        } catch (\Exception $e) {

            LoggerUtil::error("Error fetching owner list: " . $e->getMessage());

            return JsonResponse::get('500', 'Failed to retrieve agreement list.', '');
        }
    }


    public function getOwnerBasicDetails($userNumber){

        try {
            // Call API
            $response = Http::withToken($this->endPointToken)->get($this->authHost . '/api/v1/user/'.$userNumber);

            LoggerUtil::info("Owner basic details API RAW Response: " . $response->body());

            $res = $response->json();

            if ($response->status() !== 200 || ($res['status'] ?? null) !== "200") {

                LoggerUtil::warning("Failed to fetch owner basic info. Response: " . json_encode($res));

                return JsonResponse::get('500', 'Failed to retrieve owner basic info.', '');
            }

            return $res['Data'] ?? [];

        } catch (\Exception $e) {

            LoggerUtil::error("Error fetching owner info: " . $e->getMessage());

            return JsonResponse::get('500', 'Failed to retrieve owner info.', '');
        }

    }

    public function loanDetailsByLoanNumber($loanNumber,$driverNumber){
        try {
            // Call API
            $response = Http::withToken($this->endPointToken)->get($this->clientHost . '/api/v1/loan/driver-loan-details/' . $loanNumber . '/' . $driverNumber);

            LoggerUtil::info("Loan Details API RAW Response: " . $response->body());

            $res = $response->json();

            if ($response->status() !== 200 || ($res['status'] ?? null) !== "200") {

                LoggerUtil::warning("Failed to fetch loan details. Response: " . json_encode($res));

                return JsonResponse::get('500', 'Failed to retrieve loan details.', '');
            }

            return $res['Data'] ?? [];

        } catch (\Exception $e) {

            LoggerUtil::error("Error fetching loan details: " . $e->getMessage());

            return JsonResponse::get('500', 'Failed to retrieve loan details.', '');
        }
    }


    public function agreementDetailsByAgreementNumber($agreementNumber,$ownerNumber){
        try {
            // Call API
            $response = Http::withToken($this->endPointToken)->get($this->clientHost . '/api/v1/agreement/details/' . $agreementNumber . '/' . $ownerNumber);

            LoggerUtil::info("Agreement Details API RAW Response: " . $response->body());

            $res = $response->json();

            if ($response->status() !== 200 || ($res['status'] ?? null) !== "200") {

                LoggerUtil::warning("Failed to fetch agreement details. Response: " . json_encode($res));

                return JsonResponse::get('500', 'Failed to retrieve agreement details.', '');
            }

            return $res['Data'] ?? [];

        } catch (\Exception $e) {

            LoggerUtil::error("Error fetching agreement details: " . $e->getMessage());

            return JsonResponse::get('500', 'Failed to retrieve agreement details.', '');
        }
    }

    public function paymentListByOwners(){
        try {
            // Call API
            $response = Http::withToken($this->endPointToken)->get($this->clientHost . '/api/v1/payment/transactions-list');

            LoggerUtil::info("Owner Payment List API RAW Response: " . $response->body());

            $res = $response->json();

            if ($response->status() !== 200 || ($res['status'] ?? null) !== "200") {

                LoggerUtil::warning("Failed to fetch owner payment list. Response: " . json_encode($res));

                return JsonResponse::get('500', 'Failed to retrieve owner payment list.', '');
            }

            return $res['Data'] ?? [];

        } catch (\Exception $e) {

            LoggerUtil::error("Error fetching owner payment list: " . $e->getMessage());

            return JsonResponse::get('500', 'Failed to retrieve owner payment list.', '');
        }
    }


    public function paymentTransactionDriverList($loanNumber,$driverNumber){
        try {
            // Call API
            $response = Http::withToken($this->endPointToken)->get($this->clientHost . '/api/v1/payment/driver-transaction-details/'.$loanNumber.'/'.$driverNumber);

            LoggerUtil::info("Driver Payment Transaction List API RAW Response: " . $response->body());

            $res = $response->json();

            if ($response->status() !== 200 || ($res['status'] ?? null) !== "200") {

                LoggerUtil::warning("Failed to fetch driver payment transaction list. Response: " . json_encode($res));

                return JsonResponse::get('500', 'Failed to retrieve driver payment transaction list.', '');
            }

            return $res['Data'] ?? [];

        } catch (\Exception $e) {

            LoggerUtil::error("Error fetching driver payment transaction list: " . $e->getMessage());

            return JsonResponse::get('500', 'Failed to retrieve driver payment transaction list.', '');
        }
    }


}
