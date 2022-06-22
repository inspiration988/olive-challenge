<?php

namespace App\Repositories\Api\v1;

use App\Models\Transactions;
use App\Models\UserWallet;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

/**
 * Class TransactionsRepository 
 * @package App\Repositories\Api\v1
 * @version April 19, 2022, 3:11 pm +03
 */

class TransactionsRepository   extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'wallet_id',
        'amount',
        'type'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Transactions::class;
    }

    public function create($input)
    {
        $result = [];
        DB::beginTransaction();
        
        try {
            $userWallet =  UserWallet::firstOrCreate(['user_id' => Auth::guard('api')->id()]);

            /**
             * throw exception if type is withdraw with insufficient credit
             */
            if ((($userWallet->balance - $input['amount'])  < 0) && ($input['type'] == Transactions::TYPE_WITHDRAW)) {
           
                 throw new Exception("not enough money" , -1);
               
            }

            // update user wallet credit
            if ($input['type'] == Transactions::TYPE_DEPOSIT) {
                $userWallet->balance = $userWallet->balance + $input['amount'];
            } else {
                $userWallet->balance = $userWallet->balance - $input['amount'];
            }
            $userWallet->save();

            $transactionData = array_merge(
                $input,
                [
                    'wallet_id' => $userWallet->id,
                    'refrence_id' => (string) Str::uuid()
                ]
            );

            $model = $this->model->newInstance($transactionData);
            $model->save();

            DB::commit();
            $result = [
                'status' => true ,
                'message' => $model->refrence_id
            ];
            return $result;
            // all good
        } catch (\Exception $e) {
            // something went wrong
            DB::rollback();
            $result = [
                'status' => false ,
                'message' => $e->getMessage()
            ];
            return $result;
            
        }
    }
}
