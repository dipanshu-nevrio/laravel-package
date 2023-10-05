<?php

namespace test\jouren\request;

use App\Models\Jouren;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreJourenRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('jouren_create');
    }

    public function rules()
    {
        return [
            'title' => [
                'string',
                'required',
            ],
            'start_time' => [
                'date_format:' . config('project.time_format'),
                'required',
            ],
            'end_time' => [
                'date_format:' . config('project.time_format'),
                'required',
            ],
            'phone_number' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'required',
            ],
            'image' => [
                'array',
                'required',
            ],
            'image.*.id' => [
                'integer',
                'exists:media,id',
            ],
        ];
    }
}
