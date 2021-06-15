<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $table = 'tbl_bank_account';

    protected $fillable = [
        'id', 'user_id', 'bank', 'branch', 'account_type', 'account_num', 'last_name', 'first_name'
    ];
}