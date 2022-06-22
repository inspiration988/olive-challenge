<?php

namespace App\Repositories\Api\v1;

use App\Models\UserWallet;
use App\Repositories\BaseRepository;

/**
 * Class UserWalletRepository
 * @package App\Repositories\Api\v1
 * @version April 19, 2022, 3:11 pm +03
*/

class UserWalletRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'user_id',
        'balance'
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
        return UserWallet::class;
    }
}
