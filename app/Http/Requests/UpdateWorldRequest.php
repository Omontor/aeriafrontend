<?php

namespace App\Http\Requests;

use App\Models\World;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateWorldRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('world_edit');
    }

    public function rules()
    {
        return [
            'name' => [
                'string',
                'nullable',
            ],
        ];
    }
}
