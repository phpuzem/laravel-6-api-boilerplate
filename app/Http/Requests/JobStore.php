<?php

namespace App\Http\Requests;


class JobStore extends Request
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
            'race_id'     => 'required|exists:races,id',
            'name'        => 'required|unique:jobs',
            'description' => 'required',
        ];
    }
}
