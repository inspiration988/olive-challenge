<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserWallet extends Model
{
    use HasFactory;

    public $table = 'user_wallet';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';

    protected $dates = ['deleted_at'];


    public $fillable = [
        'user_id',
        'balance'
    ];


    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transactions');
    }
}
