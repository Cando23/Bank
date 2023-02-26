<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCreditPlanRequest extends FormRequest
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

                "name" => ["required", "min:3", "max:255", "unique:credit_plans,name"],
                "percent" => "required|numeric|gt:0",
                "min_amount" => "required|numeric|gt:100",
                "max_amount" => "required|numeric|gt:100|gte:min_amount",
                "min_period" => "required|numeric|gt:0",
                "max_period" => "required|numeric|gt:0|gte:min_period",
                "annuity" => "required|boolean",
        ];
    }
}
