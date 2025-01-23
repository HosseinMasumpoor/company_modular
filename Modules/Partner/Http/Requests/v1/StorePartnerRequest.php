<?php

namespace Modules\Partner\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Core\Enums\Locale;

class StorePartnerRequest extends FormRequest
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
            'name' => 'required|min:2|string',
            'locale' => ['required', Rule::in(Locale::getValues())],
            'post' => 'required|string',
            'telegram' => 'nullable',
            'linkedin' => 'nullable',
            'instagram' => 'nullable',
            'twitter' => 'nullable',
            'image' => 'required|file|mimes:png,jpg,webp',
        ];
    }
}
