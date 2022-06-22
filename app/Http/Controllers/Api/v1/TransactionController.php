<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TransactionsRequest;
use App\Http\Resources\Api\v1\TransactionResource;
use App\Models\Transactions;
use App\Models\UserWallet;
use App\Repositories\Api\v1\TransactionsRepository;
use App\Repositories\Api\v1\UserWalletRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionController extends Controller
{

    /** @var  TransactionsRepository */
    private $transactionsRepository;


    /**
     * __construct
     *
     * @param  mixed $transactionsRepository
     * @return void
     */
    public function __construct(TransactionsRepository  $transactionsRepository)
    {
        $this->transactionsRepository = $transactionsRepository;
    }

    /**
     * this method proccess request withdraw and deposit
     * request
     *
     * @param  mixed $request
     * @return void
     */
    public function request(TransactionsRequest $request)
    {

        $result = $this->transactionsRepository->create($request->all());

        if ($result['status']) {
            return Response::success('your request is successfully done with this RefrenceId : ' . $result['message']);
        }

        return Response::failed('failed ' . $result['message']);
    }


    /**
     * list all logined user transactions
     *
     * @param  mixed $request
     * @return void
     */
    public function list(Request $request)
    {

        if (empty(Auth::guard('api')->user()->userWallet)) {
            return Response::failed('User dosent create wallet yet');
        }

        $list = $this->transactionsRepository->all(
            ['wallet_id' => Auth::guard('api')->user()->userWallet->id],
            $request->get('skip'),
            $request->get('limit')
        );

        return Response::success(TransactionResource::collection($list));
    }
}
