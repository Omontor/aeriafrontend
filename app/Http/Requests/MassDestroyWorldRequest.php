<?php

namespace App\Http\Requests;

use App\Models\World;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyWorldRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('world_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:worlds,id',
        ];
    }
}
