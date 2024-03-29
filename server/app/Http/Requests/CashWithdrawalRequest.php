<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CashWithdrawalRequest extends FormRequest
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
            "amount" => "required|numeric",
            "number" => "required|exists:cards,number|numeric|digits:16",
            "pin" => "required|numeric|digits:4"
        ];
    }
}
