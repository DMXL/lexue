<?php
/**
 *
 *
 *   ______                        _____           __
 *  /_  __/__  ____ _____ ___     / ___/__  ______/ /___
 *   / / / _ \/ __ `/ __ `__ \    \__ \/ / / / __  / __ \
 *  / / /  __/ /_/ / / / / / /   ___/ / /_/ / /_/ / /_/ /
 * /_/  \___/\__,_/_/ /_/ /_/   /____/\__,_/\__,_/\____/
 *
 *
 *
 * Filename->LectureFormRequest.php
 * Project->lexue
 * Description->handle lecture form requests
 *
 * Created by DM on 16/9/4 下午11:28.
 * Copyright 2016 Team Sudo. All rights reserved.
 *
 */
namespace App\Http\Requests;

use App\Http\Requests\Request;

class LectureFormRequest extends Request
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
            'teacher_id' => 'required',
            'date' => 'required',
            'start' => 'required',
            'length' => 'required',
            'price' => 'required|numeric',
        ];
    }

    public function attributes()
    {
        // name field conflicts with name field on lectures
        return [
            'name' => '课程名称'
        ];
    }
}
