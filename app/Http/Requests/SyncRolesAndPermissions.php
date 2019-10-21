<?php

namespace App\Http\Requests;


class SyncRolesAndPermissions extends Request
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
     * @return array
     */
    public function rules()
    {
        return [
            'roles'         => 'array',
            'roles.*'       => 'integer|exists:roles,id',
            'permissions'   => 'array',
            'permissions.*' => 'integer|exists:permissions,id',
        ];
    }
}
