<?php

namespace App\Http\Controllers;

use App\Dto\JsonResponse;
use App\Service\UserService;
use App\Util\LoggerUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ManagerController extends Controller
{

    protected $authHost;
    protected $endPointToken;
    protected $userService;

    protected $clientHost;
    public function __construct(UserService $userService ){
        $this->userService = $userService;
        $this->authHost = config('app.auth_host');
        $this->endPointToken=config('app.jwt_end_point_token');
        $this->clientHost = config('app.client_host');


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

    public function ownerList(){
        return view('manager.pages.client_list');
    }

    public function ownerRegistration(){
        $user = $this->authUser();
        return view('manager.pages.client_register',[
            'user' => $user
        ]);
    }

    public function ownerRegistrationStore(Request $request){

        LoggerUtil::info("vehicle  registration request: " . json_encode($request->all()));

        $ownerInfo = $request->only(['first_name', 'last_name', 'email', 'address', 'phone', 'gender']);

        $ownerInfo['role_id'] = 4;

        try {

            $response = Http::withToken($this->endPointToken)->post($this->authHost . '/api/v1/driver/create', ['driverInfo' => $ownerInfo,]);

            LoggerUtil::info("Owner API Response RAW: " . $response->body());

            $res = $response->json();

            if ($response->status() != 200 || ($res['status'] ?? null) != "200") {

                LoggerUtil::warning("Failed to register vehicle please check again, $response");
            }

            $userNumber = $res['Data']['userNumber'];

            $ownerData= json_encode($res['Data'] ?? []);

            if (!$userNumber) {
                LoggerUtil::warning("Failed to register vehicle owner please check again, $response");
                return null;
            }
            // TODO Notification logic here


            return JsonResponse::get(200,'Owner registered successfully', $ownerData);


        } catch (\Exception $e) {
            LoggerUtil::error("Driver API ERROR: " . $e->getMessage());
            return JsonResponse::get('500','Failed to connect to Driver API', $e->getMessage());

        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
