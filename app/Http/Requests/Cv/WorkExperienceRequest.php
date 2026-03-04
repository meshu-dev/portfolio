<?php

namespace App\Http\Requests\Cv;

use Illuminate\Foundation\Http\FormRequest;

class WorkExperienceRequest extends FormRequest
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
            'title'            => 'required|string|min:6|max:250',
            'company'          => 'required|string|min:3|max:250',
            'location'         => 'required|string',
            'is_current'       => 'required|boolean',
            'start_date'       => 'required|string',
            'end_date'         => 'required_if:is_current,false',
            'description'      => 'required|string',
            'responsibilities' => 'required|array',
            'active'           => 'required|boolean',
        ];
    }
}
