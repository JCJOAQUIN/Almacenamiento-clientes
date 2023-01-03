<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cfdis extends Model
{
    use HasFactory;
    protected $fillable = 
    [
        'clabe',
        'using_description',
        'person_restricted',
    ];
}
