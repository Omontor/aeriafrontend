<?php

namespace App\Http\Requests;

use App\Models\Message;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreMessageRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('message_create');
    }

    public function rules()
    {
        return [
            'game_id' => [
                'required',
                'integer',
            ],
            'publish_date' => [
                'string',
                'nullable',
            ],
            'expiration_date' => [
                'string',
                'nullable',
            ],
            'subject' => [
                'string',
                'nullable',
            ],
            'message' => [
                'string',
                'nullable',
            ],
            'uri' => [
                'string',
                'nullable',
            ],
            'data_type' => [
                'string',
                'nullable',
            ],
            'country' => [
                'string',
                'nullable',
            ],
            'custom_data' => [
                'string',
                'nullable',
            ],
        ];
    }
}
