<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditPlan extends Model
{
    use HasFactory;
    protected $table = 'credit_plans';
    protected $guarded = false;
}
