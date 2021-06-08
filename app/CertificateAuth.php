<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class CertificateAuth extends Model
{
    protected $table = 'tbl_certificate_auth';

    protected $fillable = [
        'id', 'user_id', 'doc', 'certificate'
    ];
}