<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUserRequest extends FormRequest
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
            'name' => 'required|min:3|max:255|alpha',
            'surname' => 'required|min:3|max:255|alpha',
            'patronymic' => 'required|min:3|max:255|alpha',
            'date_of_birth' => 'required|date_format:Y-m-d\TH:i:s\Z',
            'gender' => ['required', 'regex:/[MmFf]{1}/'],
            'passport_series' => 'required|min:2|max:2|alpha',
            'passport_number' => ['required', 'numeric:7', Rule::unique('users')->ignore($this->route('user'))],
            'passport_id_number' => ['required', Rule::unique('users')->ignore($this->route('user')), 'regex:/\d{7}[A-Z]\d{3}[A-Z]{2}\d/'],
            'passport_issued_by' => 'required|min:3|max:255,alpha',
            'passport_issue_date' => 'required|date_format:Y-m-d\TH:i:s\Z',
            'place_of_birth' => 'required|min:3|max:255',
            'personal_phone' => ['regex:/\+375(33|25|44|29)\d{7}/'],
            'home_phone' => ['regex:/8029\d{7}/'],
            'residence_address' => 'required|min:2|max:255',
            'email' => ['email', Rule::unique('users')->ignore($this->route('user'))],
            'residence_city_id' => 'required|exists:cities,id|numeric',
            'registration_city_id' => 'required|exists:cities,id|numeric',
            'marital_status_id' => 'required|exists:marital_statuses,id|numeric',
            'citizenship_id' => 'required|exists:citizenships,id|numeric',
            'disability_id' => 'required|exists:disabilities,id|numeric',
            'pensioner' => 'required|boolean',
            'income' => 'decimal:0,2'
        ];
    }
}
