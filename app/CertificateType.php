<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class CertificateType extends Model
{
    protected $table = 'tbl_certificate_type';

    protected $fillable = [
        'id', 'certificate'
    ];
}