<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Repositories\Api\v1\UserWalletRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;


class UserWalletController extends Controller
{


    /** @var  UserWalletRepository */

    private $userWalletRepository;
    
    /**
     * __construct
     *
     * @param  mixed $userWalletRepository
     * @return void
     */
    public function __construct(UserWalletRepository $userWalletRepository)
    {

        $this->userWalletRepository = $userWalletRepository;
    }

    
    /**
     * retrive logined user credit amount
     * creditAmount
     *
     * @return void
     */
    public function creditAmount()
    {
        if (empty(Auth::guard('api')->user()->userWallet)) {
            return Response::failed('User dosent have wallet yet');
        }
        return Response::success(Auth::guard('api')->user()->userWallet->balance);
    }
}
