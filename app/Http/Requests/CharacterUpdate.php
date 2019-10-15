<?php

namespace App\Http\Requests;


use Illuminate\Validation\Rule;

class CharacterUpdate extends Request
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
            'job_id'        => 'required|exists:jobs,id',
            'appearance_id' => 'required',
            'name'          => [
                'required',
                Rule::unique('characters')->ignore($this->character),
            ],
            'gender'        => 'required|boolean',
        ];
    }
}
