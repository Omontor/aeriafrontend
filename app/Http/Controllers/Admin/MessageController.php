<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMessageRequest;
use App\Http\Requests\StoreMessageRequest;
use App\Http\Requests\UpdateMessageRequest;
use App\Models\Game;
use App\Models\Message;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MessageController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('message_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $messages = Message::with(['game'])->get();

        $games = Game::get();

        return view('admin.messages.index', compact('messages', 'games'));
    }

    public function create()
    {
        abort_if(Gate::denies('message_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $games = Game::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.messages.create', compact('games'));
    }

    public function store(StoreMessageRequest $request)
    {
        $message = Message::create($request->all());

        return redirect()->route('admin.messages.index');
    }

    public function edit(Message $message)
    {
        abort_if(Gate::denies('message_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $games = Game::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $message->load('game');

        return view('admin.messages.edit', compact('games', 'message'));
    }

    public function update(UpdateMessageRequest $request, Message $message)
    {
        $message->update($request->all());

        return redirect()->route('admin.messages.index');
    }

    public function show(Message $message)
    {
        abort_if(Gate::denies('message_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $message->load('game');

        return view('admin.messages.show', compact('message'));
    }

    public function destroy(Message $message)
    {
        abort_if(Gate::denies('message_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $message->delete();

        return back();
    }

    public function massDestroy(MassDestroyMessageRequest $request)
    {
        Message::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
