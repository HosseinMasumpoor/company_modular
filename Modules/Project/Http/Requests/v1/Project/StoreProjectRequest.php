<?php

namespace Modules\Project\Http\Requests\v1\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Core\Enums\Locale;

class StoreProjectRequest extends FormRequest
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
            'name' => 'required|min:5|max:200',
            'locale' => ['required', Rule::in(Locale::getValues())],
            'slug' => 'unique:projects,slug',
            'summary' => 'required|string|min:2|max:300',
            'tech_description' => 'required|string|min:2|max:300',
            'feature_description' => 'required|string|min:2|max:300',
            'presentation_des' => 'nullable|string|min:2|max:300',
            'presentation_file' => 'nullable|file|mimes:pdf|max:10000',
            'working_days' => 'required|numeric|integer|between:0,1000',
            'link' => 'nullable',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'technologies' => 'required|array',
            'technologies.*' => 'exists:technologies,id',
            'image' => 'required|image|mimes:png,jpg,svg,webp|max:2000',
            'alt' => 'nullable|string',
            'meta_title' => 'nullable|string',
            'meta_tags' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ];
    }
}
