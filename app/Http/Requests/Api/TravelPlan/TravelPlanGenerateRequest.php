<?php

namespace App\Http\Requests\Api\TravelPlan;

use Illuminate\Foundation\Http\FormRequest;

class TravelPlanGenerateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'destination' => 'required|string',
            'travelDays' => 'required|integer|min:1',
            'travelersCount' => 'required|integer|min:1',
            'budget' => 'required|string',
            'travelPace' => 'required|string',
            'culturalPreferences' => 'required|string',
            'foodPreferences' => 'required|string',
            'travelExperience' => 'required|string',
            'accommodation' => 'required|string',
            'activities' => 'required|string',
        ];
    }
}
