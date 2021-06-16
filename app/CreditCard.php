<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    protected $table = 'tbl_credit_card';

    protected $fillable = [
        'id', 'user_id', 'card_num', 'security_code', 'expired_year', 'expired_month'
    ];
}