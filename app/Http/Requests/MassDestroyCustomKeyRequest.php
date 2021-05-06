<?php

namespace App\Http\Requests;

use App\Models\CustomKey;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyCustomKeyRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('custom_key_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:custom_keys,id',
        ];
    }
}
