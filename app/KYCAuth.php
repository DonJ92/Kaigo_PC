<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class KYCAuth extends Model
{
    protected $table = 'tbl_kyc_auth';

    protected $fillable = [
        'id', 'user_id', 'doc', 'birthday'
    ];
}