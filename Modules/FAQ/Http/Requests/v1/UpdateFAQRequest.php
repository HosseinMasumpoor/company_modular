<?php

namespace Modules\FAQ\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Core\Enums\Locale;

class UpdateFAQRequest extends FormRequest
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
            'locale' => ['sometimes', Rule::in(Locale::getValues())],
            'title' => 'sometimes|string|min:2|max:300',
            'text' => 'sometimes|string|min:2|max:400'
        ];
    }
}
