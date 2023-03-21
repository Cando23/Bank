<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $casts = [
        'debit' => 'double',
        'credit' => 'double',
        'balance' => 'double',
    ];
    protected $table = 'accounts';
    protected $guarded = false;
}
