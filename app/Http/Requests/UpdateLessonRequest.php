<?php

namespace App\Http\Requests;

use App\Models\Lesson;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateLessonRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('lesson_edit');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'slug' => [
                'string',
                'required',
                'unique:lessons,slug,' . request()->route('lesson')->id,
            ],
            'position' => [
                'required',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
