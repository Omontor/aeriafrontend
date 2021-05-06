<?php

namespace App\Http\Requests;

use App\Models\Analytic;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateAnalyticRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('analytic_edit');
    }

    public function rules()
    {
        return [
            'bvc' => [
                'string',
                'nullable',
            ],
            'game_id' => [
                'required',
                'integer',
            ],
            'entry' => [
                'string',
                'nullable',
            ],
            'value' => [
                'string',
                'nullable',
            ],
        ];
    }
}
