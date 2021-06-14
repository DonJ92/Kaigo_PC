<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Favourite extends Model
{
    protected $table = 'tbl_favourite';

    protected $fillable = [
        'id', 'user_id', 'target_id', 'type'
    ];
}