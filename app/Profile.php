<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $table = 'tbl_profile';

    protected $fillable = [
        'id', 'user_id', 'introduction', 'photo1', 'photo2', 'photo3', 'photo4', 'photo5',
        'age', 'experience_years', 'job_type', 'certificate', 'hourly_cost_from', 'hourly_cost_to'
    ];
}