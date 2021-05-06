<?php

namespace App\Http\Requests;

use App\Models\Level;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreLevelRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('level_create');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'required',
            ],
            'name_in_build' => [
                'string',
                'nullable',
            ],
        ];
    }
}
