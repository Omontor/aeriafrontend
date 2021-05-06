<?php

namespace App\Http\Requests;

use App\Models\CustomKey;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreCustomKeyRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('custom_key_create');
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
