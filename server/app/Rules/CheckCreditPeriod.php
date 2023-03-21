<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class CheckCreditPeriod implements Rule
{
    protected $plan_id;

    public function __construct($plan_id)
    {
        $this->plan_id = $plan_id;
    }

    public function passes($attribute, $value)
    {
        $credit = DB::table("credit_plans")->find($this->plan_id);
        if ($credit) {
            $creditPlan = DB::table('credit_plans')->select('min_period', 'max_period')->find($this->plan_id);
            return $value >= $creditPlan->min_period && $value <= $creditPlan->max_period;
        }
        return false;
    }

    public function message()
    {
        return 'The credit period must be between the min and max values of the selected credit plan.';
    }
}
