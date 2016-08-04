<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TeacherFormRequest extends Request
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
            'name' => 'required',
            'email' => 'required|unique:teachers,email,'. $this->route('teachers'),
            'unit_price' => 'required|numeric',
            'teaching_since' => 'required|regex:/\d{4}/',
        ];
    }

    public function attributes()
    {
        // name field conflicts with name field on users
        return [
            'name' => '教师名字'
        ];
    }
}
