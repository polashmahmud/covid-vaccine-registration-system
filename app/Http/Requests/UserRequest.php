<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Models\VaccineCenter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'nid' => ['required', 'digits:17', 'unique:'.User::class],
            'vaccine_center_id' => ['required', 'exists:'.VaccineCenter::class.',id'],
            'email' => ['required', 'string', 'email', 'lowercase', 'max:255', 'unique:'.User::class],
            'email_verified_at' => ['nullable', 'date'],
            'password' => ['required', 'confirmed', 'string', 'min:8'],
        ];
    }

    public function messages()
    {
        return [
            'nid.digits' => 'NID must be 17 digits.',
            'nid.unique' => 'NID already exists.',
            'vaccine_center_id.required' => 'Vaccine center is required.',
            'vaccine_center_id.exists' => 'Vaccine center does not exist.',
            'email.unique' => 'Email already exists.',
            'password.min' => 'Password must be at least 8 characters.',
        ];
    }

    public function authorize()
    {
        return true;
    }
}
