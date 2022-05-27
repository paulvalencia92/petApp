<?php

namespace App\Http\Requests;

use App\Models\Pet;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PetRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => ['required', Rule::exists('categories', 'id')],
            'name' => ['required'],
            'photoUrls' => 'nullable|sometimes|image|mimes:jpg,jpeg,png',
            'status' => ['required', Rule::in(Pet::availableValues())],
        ];
    }
}
