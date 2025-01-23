<?php

namespace Modules\Role\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
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

            'name' => ['required', 'string', 'min:3', 'max:150'],
            'role_id' => ['required', 'exists:roles,id'],
            'email' => ['sometimes', 'required', 'string', 'min:3', 'max:150'],
            'username' => ['required', 'unique:admins,username', 'min:3', 'max:150'],
            'password' => ['required', 'string', 'min:6', 'max:150'],

        ];
    }
}
