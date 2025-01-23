<?php

namespace Modules\Service\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Core\Enums\Locale;

class StoreServiceRequest extends FormRequest
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
            'name' => 'required|min:4|max:100',
            'slug' => 'nullable|unique:services,id',
            'locale' => ['required',Rule::in(Locale::getValues())],
            'image' => 'required|image|mimes:jpg,png,webp|max:4000',
            'body' => 'nullable|string',
            'icon' => 'required|image|mimes:png,svg,webp|max:2048',
            'summary' => 'required|min:5|max:800',
            'slogan' => 'required|min:4|max:190',
            'meta_title' => 'nullable|min:4|max:190',
            'meta_description' => 'nullable|min:4|max:500',
            'meta_tags' => 'nullable|min:4|max:190',
        ];
    }
}
