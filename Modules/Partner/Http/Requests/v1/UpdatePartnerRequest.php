<?php

namespace Modules\Partner\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Core\Enums\Locale;

class UpdatePartnerRequest extends FormRequest
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
            'name' => 'sometimes|min:2|string',
            'locale' => ['sometimes', Rule::in(Locale::getValues())],
            'post' => 'sometimes|string',
            'telegram' => 'nullable',
            'linkedin' => 'nullable',
            'instagram' => 'nullable',
            'twitter' => 'nullable',
            'image' => 'nullable|file|mimes:png,jpg,webp',
        ];
    }
}
