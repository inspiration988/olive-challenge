<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transactions extends Model
{
    use HasFactory;
    public $table = 'transactions';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];


    const TYPE_WITHDRAW = 1 ;
    const TYPE_DEPOSIT =  2 ;

    public $fillable = [
        'wallet_id',
        'amount',
        'type',
        'refrence_id'
    ];

    public function userWallet()
    {
        return $this->belongsTo('App\Models\UserWallet');
    }

}
