<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'tbl_customer'; 
    protected $fillable = [
        'Username',
        'Email',
        'Wa',
        'Bank',
        'NamaRek',
        'NoRek',
    ];
}
