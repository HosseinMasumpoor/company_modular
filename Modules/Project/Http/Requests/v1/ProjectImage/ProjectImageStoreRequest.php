<?php

namespace Modules\Project\Http\Requests\v1\ProjectImage;

use Illuminate\Foundation\Http\FormRequest;

class ProjectImageStoreRequest extends FormRequest
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
            'image' => 'required|image|max:2048|mimes:png,jpg,webp,svg',
        ];
    }
}
