<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class JobType extends Model
{
    protected $table = 'tbl_job_type';

    protected $fillable = [
        'id', 'job_type'
    ];
}