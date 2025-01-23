<?php

namespace Modules\Experience\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Core\Enums\Locale;

class UpdateExperienceRequest extends FormRequest
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
            'name' => 'sometimes|string|min:2|max:100',
            'locale' => ['sometimes', Rule::in(Locale::getValues())],
            'job_title' => 'sometimes|string|min:2|max:100',
            'text' => 'sometimes|string|min:2|max:400',
            'image' => 'sometimes|image|mimes:png,jpg,svg,webp|max:2048',
        ];
    }
}
