<?php

namespace Modules\Role\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PermissionRolesRequest extends FormRequest
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
            "role_id" => "required|exists:roles,id",
            "permissions" => ['array', 'required'],
            "permissions.*.id" => ['exists:permissions,id', 'required'],
        ];
    }
}
