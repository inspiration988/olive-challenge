<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Repositories\Api\v1\UsersRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\UserRequest;

class AuthController extends Controller
{

    /**
     * __construct
     *
     * @param  mixed $userRepository
     * @return void
     */
    public function __construct(UsersRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        
    }

    /**
     * login method
     *
     * @param  mixed $request
     * @return void
     */
    public function login(Request $request)
    {
        $login_credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (auth()->attempt($login_credentials)) {
            //generate the token for the user

            $token = auth()->user()->createToken('accessToken')->accessToken;

            return Response::success(['token' => $token]);
        } else {
            //wrong login credentials, return, user not authorised to our system, return error code 401
            return Response::failed(['token' => 'UnAuthorised Access'], 401);
        }
    }


    public function register(UserRequest $request)
    {
       

        $user = $this->userRepository->create([
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('accessToken')->accessToken;

        return Response::success(['token' => $token]);
    }
}
