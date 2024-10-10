<?php

namespace App\Http\Requests;

use App\Models\VaccineCenter;
use Illuminate\Foundation\Http\FormRequest;

class VaccineScheduleRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'vaccine_center_id' => ['required', 'exists:'.VaccineCenter::class.',id'],
            'scheduled_date' => ['required', 'date'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
