<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule;

class RoleUpdate extends Request
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
            'name'       => [
                'required',
                Rule::unique('permissions')->ignore($this->role),
                Rule::unique('roles')->ignore($this->role),
            ],
            'guard_name' => 'required',
        ];
    }
}
