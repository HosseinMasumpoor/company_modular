<?php

namespace Modules\Article\Http\Requests\v1\Article;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Core\Enums\Locale;

class StoreArticleRequest extends FormRequest
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
            'title' => 'required|string',
            'locale' => ['required', Rule::in(Locale::getValues())],
            'slug' => 'nullable|unique:products,slug',
            'category_id' => 'required|exists:categories,id',
            'summary' => 'required|string|max:400',
            'image' => 'required|file|mimes:png,jpg,webp|max:2048',
            'thumbnail' => 'nullable|file|mimes:png,jpg,webp|max:2048',
            'read_time' => 'required|numeric|min:1|max:1000',
            'sections' => 'required|array|min:1',
            'sections.*.title' => 'required|string|min:4|max:300',
            'sections.*.body' => 'required|string|min:4',
            'alt' => 'nullable|max:300',
            'meta_title' => 'nullable|string',
            'meta_tags' => 'nullable|string',
            'meta_description' => 'nullable|string',
        ];
    }
}
