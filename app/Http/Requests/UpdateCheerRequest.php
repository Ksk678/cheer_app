<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCheerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rule = [
            // "first_name" = "required|string|max:20",
            // "last_name" = "required|string|max:20",
            // "position" = "required|string|max:20",
            // "age" = "required|string|max:20",
            // "dob" = "required|string|max:20",
            // "height" = "required|string|max:20",
            // "weight" = "required|string|max:20",
            // "nationality" = "required|string|max:20",
            // "passport" = "required|string|max:20",
        ];

        if ($this->file("image")) {
            $rule["image"] = "required|file|image|mimes:jpg,png";
        }

        return $rule;
    }
}
