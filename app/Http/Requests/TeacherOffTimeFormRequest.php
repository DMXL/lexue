<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class TeacherOffTimeFormRequest extends Request
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
            'date' => 'required|date',
            'time_slot_id' => 'required|exists:time_slots,id'
        ];
    }

    public function messages()
    {
        return [
            '*' => '提交的数据有误'
        ];
    }
}
