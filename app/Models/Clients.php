<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clients extends Model
{
    use HasFactory, SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable =
    [
        'kind',
        'rfc',
        'name_physical',
        'last_name',
        'second_last_name',
        'name_moral',
        'business_name',
        'using_cfdi_id',
        'status',
        'contact_name',
        'phone',
        'celphone',
        'email_address',
        'comments',
        'country_id',
        'state',
        'district',
        'city',
        'zip_code',
        'suburb',
        'street',
        'external_number',
        'inside_number'
    ];
    function fullName(){
        return $this->name_physical.' '.$this->last_name.' '.$this->second_last_name;
    }
}
