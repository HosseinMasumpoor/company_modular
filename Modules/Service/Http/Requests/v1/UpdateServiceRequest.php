<?php

namespace Modules\Service\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Core\Enums\Locale;

class UpdateServiceRequest extends FormRequest
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
            'name' => 'sometimes|min:4|max:100',
            'slug' => 'nullable|unique:services,id,' . $this->id,
            'locale' => ['sometimes',Rule::in(Locale::getValues())],
            'image' => 'nullable|image|mimes:jpg,png,webp|max:4000',
            'body' => 'nullable|string',
            'icon' => 'nullable|file|mimes:png,svg,webp|max:2048',
            'light_icon' => 'nullable|file|mimes:png,svg,webp|max:2048',
            'summary' => 'sometimes|min:5|max:800',
            'slogan' => 'sometimes|min:4|max:190',
            'meta_title' => 'sometimes|min:4|max:190',
            'meta_description' => 'sometimes|min:4|max:500',
            'meta_tags' => 'sometimes|min:4|max:190',
        ];
    }
}
