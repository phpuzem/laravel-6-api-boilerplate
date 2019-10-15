<?php

namespace App\Http\Requests;


class CharacterStore extends Request
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
            'user_id'       => 'required|exists:users,id',
            'job_id'        => 'required|exists:jobs,id',
            'appearance_id' => 'required',
            'name'          => 'required|unique:characters',
            'gender'        => 'required|boolean',
        ];
    }
}
