<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'tbl_job';

    protected $fillable = [
        'id', 'user_id', 'title', 'period', 'from_time', 'to_time', 'type', 'province', 'city', 'address', 'cost',
        'certificate', 'accident', 'traffic_cost', 'payment_method', 'coupon', 'name', 'email', 'phone', 'comment', 'status'
    ];
}