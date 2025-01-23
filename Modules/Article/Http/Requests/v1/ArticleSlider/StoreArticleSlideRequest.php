<?php

namespace Modules\Article\Http\Requests\v1\ArticleSlider;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleSlideRequest extends FormRequest
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
            'article_id' => 'exists:articles,id|unique:article_sliders,article_id'
        ];
    }
}
