<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountPlan extends Model
{
    use HasFactory;

    protected $table = 'account_plans';
    protected $guarded = false;
}
