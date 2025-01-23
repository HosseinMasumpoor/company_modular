<?php

namespace Modules\Role\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditAdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {

        return [

            'name' => ['sometimes', 'required', 'string', 'min:3', 'max:150'],
            'role_id' => ['sometimes', 'required', 'exists:roles,id'],
            'email' => ['sometimes', 'required', 'string', 'min:3', 'max:150'],
            'username' => ['sometimes', 'required', 'unique:admins,username', 'min:3', 'max:150'],
            'password' => ['sometimes', 'required', 'string', 'min:6', 'max:150'],

        ];
    }
}
