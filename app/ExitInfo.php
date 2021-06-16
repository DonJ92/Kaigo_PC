<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class ExitInfo extends Model
{
    protected $table = 'tbl_exit_info';

    protected $fillable = [
        'id', 'cause', 'opinion'
    ];
}