<?php

namespace App\Http\Controllers;

use App\Service\UserService;
use App\Util\LoggerUtil;
use App\Util\RolesAssign;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SSOLoginController extends Controller
{
    protected $userService;
    protected $authHost;
    public function __construct(UserService $userService, ){
        $this->userService = $userService;
        $this->authHost = config('app.auth_host');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function ssoLogin(Request $request){
        try {

            $code = $request->query('code');

            if (!$code) {
                abort(401, "Missing SSO code");
            }

            $response = Http::get($this->authHost . '/api/v1/sso/exchange', ['code' => $code,]);
            if ($response->failed()) {

                abort(401, "Invalid or expired SSO code");
            }

            $data = $response->json();

            $token = $data['token'];
            $user  = $data['user']; // full user object
            LoggerUtil::info("The user data received from SSO login is ".json_encode($user));

            // Create or find the user by userNumber
            $createdUser = $this->userService->createUser($user);

            LoggerUtil::info("The user data received from SSO login is ".json_encode($createdUser));

            session(['jwt_token' => $token, 'user' => $createdUser]);

            // Determine role and redirect
            $roleName = ($createdUser['role_name']);

            LoggerUtil::info("Redirecting user based on role: {$roleName}");

            if ($roleName === RolesAssign::MANAGER) {

                return redirect('/manager/dashboard');

            } elseif ($roleName === RolesAssign::HELPDESK) {

                return redirect('/help/dashboard');

            } else {

                return redirect($this->authHost.'/login');
            }

        }catch (\Exception $exception){

            LoggerUtil::error("SSO Login error: ".$exception->getMessage());

            abort(500, "Internal Server Error during SSO login");
        }
    }


    public function ssoLogout(Request $request){
        $token = session('jwt_token');

        if ($token) {
            // Call Auth Module API to invalidate token
            $authApi = $this->authHost.'/api/v1/logout';

            Http::withHeaders(['Authorization' => 'Bearer ' . $token, ])->post($authApi);

            // Clear local session
            session()->forget(['jwt_token', 'user']);
        }

        return redirect($this->authHost.'/login');
    }

}
