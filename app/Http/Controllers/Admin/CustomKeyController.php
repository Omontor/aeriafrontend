<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCustomKeyRequest;
use App\Http\Requests\StoreCustomKeyRequest;
use App\Http\Requests\UpdateCustomKeyRequest;
use App\Models\Analytic;
use App\Models\CustomKey;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomKeyController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('custom_key_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customKeys = CustomKey::with(['analytic'])->get();

        $analytics = Analytic::get();

        return view('admin.customKeys.index', compact('customKeys', 'analytics'));
    }

    public function create()
    {
        abort_if(Gate::denies('custom_key_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $analytics = Analytic::all()->pluck('bvc', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.customKeys.create', compact('analytics'));
    }

    public function store(StoreCustomKeyRequest $request)
    {
        $customKey = CustomKey::create($request->all());

        return redirect()->route('admin.custom-keys.index');
    }

    public function edit(CustomKey $customKey)
    {
        abort_if(Gate::denies('custom_key_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $analytics = Analytic::all()->pluck('bvc', 'id')->prepend(trans('global.pleaseSelect'), '');

        $customKey->load('analytic');

        return view('admin.customKeys.edit', compact('analytics', 'customKey'));
    }

    public function update(UpdateCustomKeyRequest $request, CustomKey $customKey)
    {
        $customKey->update($request->all());

        return redirect()->route('admin.custom-keys.index');
    }

    public function show(CustomKey $customKey)
    {
        abort_if(Gate::denies('custom_key_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customKey->load('analytic');

        return view('admin.customKeys.show', compact('customKey'));
    }

    public function destroy(CustomKey $customKey)
    {
        abort_if(Gate::denies('custom_key_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $customKey->delete();

        return back();
    }

    public function massDestroy(MassDestroyCustomKeyRequest $request)
    {
        CustomKey::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
