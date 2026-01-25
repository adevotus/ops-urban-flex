<?php

namespace App\Http\Controllers;

use App\Dto\JsonResponse;
use App\Service\NotificationService;
use App\Service\UserService;
use App\Util\LoggerUtil;
use App\Models\AgreementOwner;
use App\Models\CollectionAccount;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;



class ManagerController extends Controller
{

    protected $authHost;
    protected $endPointToken;
    protected $userService;
    protected $notificationService;
    protected $sharedController;

    public function __construct(UserService $userService , NotificationService $notificationService ,SharedController $sharedController){
        $this->userService = $userService;
        $this->authHost = config('app.auth_host');
        $this->endPointToken=config('app.jwt_end_point_token');
        $this->clientHost = config('app.client_host');
        $this->notificationService = $notificationService;
        $this->sharedController =$sharedController;

    }
    protected function authUser()
    {
        $user = session('user');
        if (!$user) { abort(401, "Unauthorized. Please log in.");}
        return $user;
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\View\View
     */
    public function index(){

        return view('manager.dashboard');
    }

    public function vehicleDashboard(){

        $ownerCountsSummary = $this->sharedController->ownersSummaryCounts();
         $ownerList = $this->sharedController->ownerList();

           // dd($ownerCountsSummary);

            return view('manager.dashboard',[
                   'ownerSummary' => (array) $ownerCountsSummary,
                   'total_owner_count' => count($ownerList)

            ]);
    }

    public function propertyDashboard(){
        return view('manager.dashboard_prop');
    }

    public function ownerList(){

        $ownerList = $this->sharedController->ownerList();

          //dd($ownerList);
        return view('manager.pages.client_list', ['ownerList' => $ownerList]);


    }

   public function ownerVehicleDetails($ownerNumber)
    {
        // Log the owner number
        LoggerUtil::info("The vehicle Owner number: $ownerNumber");

        if (!$ownerNumber) {
            return redirect()->back()->with('error', 'Owner number is required.');
        }

        $ownerData = $this->sharedController->getOwnerBasicDetails($ownerNumber);

        $agreementData = AgreementOwner::where('owner_number', $ownerNumber)->get();

        $collectionData = CollectionAccount::where('owner_number', $ownerNumber)->get();

       LoggerUtil::info("The vehicle Owner details are: " . json_encode($ownerData) . " | Agreements: " . json_encode($agreementData) . " | Collections: " . json_encode($collectionData));


        return view('manager.pages.components.owner_details', [
            'ownerData' => $ownerData,
            'agreementData' => $agreementData,
            'collectionData' => $collectionData,
        ]);
    }


    public function ownerRegistration(){
        $user = $this->authUser();
        return view('manager.pages.client_register',[
            'user' => $user
        ]);
    }

    public function ownerRegistrationStore(Request $request){

        $user = $this->authUser();

        LoggerUtil::info("owner  registration request: " . json_encode($request->all()));

        $ownerInfo = $request->only(['first_name', 'last_name', 'email', 'address', 'phone', 'gender']);

        $collectionsData = $request->only(['collection_method','account_number','account_name','collection_day','collection_notes']);

        $agreementData = $request->only(['remarks','agreement_number','agreement_type','profit_percentage','payment_mode','penalty_percentage','status','agreements_notes']);

        $ownerInfo['role_id'] = 4;

        try {

            $response = Http::withToken($this->endPointToken)->post($this->authHost . '/api/v1/driver/create', ['driverInfo' => $ownerInfo,]);

            LoggerUtil::info("Owner API Response RAW: " . $response->body());

            $res = $response->json();

            if ($response->status() != 200 || ($res['status'] ?? null) != "200") {

                LoggerUtil::warning("Failed to register vehicle please check again, $response");
            }

            $owenNumber = $res['Data']['userNumber'];

            $ownerData= json_encode($res['Data'] ?? []);

            if (!$owenNumber) {
                LoggerUtil::warning("Failed to register vehicle owner please check again, $response");
                return null;
            }
            // TODO Notification logic here

            $this->notificationService->sendOwnerRegistrationNotification( $ownerInfo['first_name'], $ownerInfo['email'], $ownerInfo['phone'], $user->userNumber);

            DB::transaction(function () use ($owenNumber, $agreementData, $collectionsData) {

                $this->createOwnerAgreement($owenNumber, $agreementData);

                LoggerUtil::info('Agreements was created ', [  'ownerNumber' => $owenNumber,  'agreement' => $agreementData    ]);


                $this->collectAccountCreations($owenNumber, $collectionsData);

                LoggerUtil::info('Creating collection account', [  'ownerNumber' => $owenNumber,  'collection' => $collectionsData    ]);

            });

            return JsonResponse::get(200,'Owner registered successfully', $ownerData);


        } catch (\Exception $e) {
            LoggerUtil::error("Driver API ERROR: " . $e->getMessage());
            return JsonResponse::get('500','Failed to connect to Driver API', $e->getMessage());

        }

    }


  protected function collectAccountCreations($owenNumber, array $collectionsData): void
    {
        LoggerUtil::info('Creating collection account', [  'ownerNumber' => $owenNumber,  'collection' => $collectionsData    ]);

     if (!$owenNumber) {
                LoggerUtil::warning('Owner number missing, cannot create agreement');
                return;
            }

        CollectionAccount::create([
            'owner_number'       => $owenNumber,
            'collection_method'  => $collectionsData['collection_method'],
            'account_number'     => $collectionsData['account_number'],
            'account_name'       => $collectionsData['account_name'],
            'collection_day'     => $collectionsData['collection_day'],
            'collection_notes'   => $collectionsData['collection_notes'] ?? null,
        ]);
    }


    protected function createOwnerAgreement($owenNumber, array $agreementData): void
        {
            LoggerUtil::info('Creating owner agreement', ['owner' => $owenNumber,   'agreement' => $agreementData  ]);



            if (!$owenNumber) {
                LoggerUtil::warning('Owner number missing, cannot create agreement');
                return;
            }

            AgreementOwner::create([
                'owner_number'       => $owenNumber,
                'agreement_number'   => $agreementData['agreement_number'],
                'agreement_type'     => $agreementData['agreement_type'],
                'profit_percentage'  => $agreementData['profit_percentage'],
                'payment_mode'       => $agreementData['payment_mode'],
                'penalty_percentage' => $agreementData['penalty_percentage'] ?? 0,
                'status'             => $agreementData['status'] ?? 'ACTIVE',
                'agreements_notes'   => $agreementData['agreements_notes'] ?? null,
            ]);
        }



    public function vehicleList(){

        $vehicleList = $this->sharedController->vehicleList();

        return view('manager.pages.vehicle_list', ['vehicleList' => $vehicleList]);

    }



    public function driverList(){

        $driverList = $this->sharedController->driverList();

        $driverList = collect($driverList)->map(function ($driver) {
            if (isset($driver['additional_info']) && is_string($driver['additional_info'])) {$driver['additional_info'] = json_decode($driver['additional_info'], true);}
            return $driver;
        })->toArray();

        return view('manager.pages.driver_list', ['driverList' => $driverList]);

    }


    public  function loanList(){

        $loanList = $this->sharedController->loanList();

        return view('manager.pages.loan_list', ['loanList' => $loanList]);

    }



    public function agreementList(){

        $agreementList = $this->sharedController->agreementList();

        return view('manager.pages.agreement_list', ['agreementList' => $agreementList]);

    }


    public function ownerTransactionsList(){


        $paymentList = $this->sharedController->paymentListByOwners();

       // dd($paymentList);
        return view('manager.pages.payment_list', ['paymentList' => $paymentList]  );
    }



    public function ownerPaymentTransactionsDriverList($loanNumber, $driverNumber){

        $transactionList = $this->sharedController->paymentTransactionDriverList($loanNumber, $driverNumber);

        // dd($transactionList);
        return view('manager.pages.components.payment_history_detatils', ['transactionList' => $transactionList, 'totalPaidAmount' =>$transactionList['total_paid_amount']],  );
    }



    public function driverRegistrationStore(Request $request){
        return null;
    }

    public function landLordList(){

        $landLordList = $this->sharedController->landLordList();
        return view('manager.pages.landlord_list',[
            'landlords' => $landLordList
        ]);
    }
    public function landLordRegister(){
        return view('manager.pages.components.landlord_registrations');
    }


}
