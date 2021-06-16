<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class NoticeSetting extends Model
{
    protected $table = 'tbl_notice_setting';

    protected $fillable = [
        'id', 'user_id', 'favourite', 'matching', 'message', 'notice', 'other'
    ];
}