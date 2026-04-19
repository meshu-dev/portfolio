<?php

namespace App\Http\Requests;

use App\Actions\Type\GetAllTypesAction;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SiteRequest extends FormRequest
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
            'name'          => 'required|string',
            'url'           => 'required|string',
            'types'         => 'required|array|distinct',
            'types.*'       => 'exists:types,id',
            'icon'          => 'required|string',
            'image'         => 'sometimes|image',
            'remove_image'  => 'sometimes|boolean',
        ];
    }
}
