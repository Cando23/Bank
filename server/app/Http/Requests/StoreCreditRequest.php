<?php

namespace App\Http\Requests;

use App\Rules\CheckCreditPeriod;
use Illuminate\Foundation\Http\FormRequest;

class StoreCreditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $plan_id = $this->input("plan_id");
        return [
            'plan_id' => "required|exists:credit_plans,id|numeric",
            'amount' => "required|numeric|between:101.00,9999999999.99",
            "user_id" => "required|exists:users,id|numeric",
            'period' => ["required", "numeric", "gt:0", new CheckCreditPeriod($plan_id)],
        ];
    }
}
