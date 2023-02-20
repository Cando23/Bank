<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepositPlanRequest extends FormRequest
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
        return [
            "name" => ["required", "min:3", "max:255", "unique:deposit_plans,name"],
            "percent" => "required|numeric|gt:0",
            "period_in_days" => "required|numeric|gt:0",
            "revocable" => "required|boolean",
        ];
    }
}
