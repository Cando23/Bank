<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepositPlan extends Model
{
    use HasFactory;

    protected $table = 'deposit_plans';
    protected $guarded = false;
}
