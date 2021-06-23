<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyAnalyticRequest;
use App\Http\Requests\StoreAnalyticRequest;
use App\Http\Requests\UpdateAnalyticRequest;
use App\Models\Analytic;
use App\Models\Game;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
//Import these lines in every controller that uses API
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Redirect;

class AnalyticController extends Controller
{
    public function index()
    {
  $client = new Client([
            'base_uri' => env('REMOTE_URL'),
            'timeout'  => 2.0,
            'verify' => false

        ]);

        $response = $client->request('GET', '/api/AeriaAnalytics/AllAnalytics');
        $analytics = json_decode($response->getBody()->getContents());

        return view('admin.analytics.index', compact('analytics'));
    }



    public function create()
    {

          $client = new Client([
            'base_uri' => env('REMOTE_URL'),
            'timeout'  => 2.0,
            'verify' => false

        ]);
     $response = $client->request('GET', '/api/Game/AllGames');
        $games = json_decode($response->getBody()->getContents());

        return view('admin.analytics.create', compact('games'));
    }

    public function store(Request $request)
    {
      


  $client = new Client([
                        'base_uri' => env('REMOTE_URL'),
                        'timeout'  => 2.0,
                        'verify' => false

                    ]);
            try { 
            $response = $client->request('POST', '/api/AeriaAnalytics/create', 
                ['json' => 
                    [
                    'id'=> 0,   
                    'name' => $request->name,
                    ]

                 ]);
            return redirect::route('admin.analytics.index')->with('success', 'Analytic Created Successfully');
            } 
            catch (Exception $e) {
                
                 return redirect::route('admin.analytics.index')->with('error', $e);

            }



    }

    public function edit(Analytic $analytic)
    {
        abort_if(Gate::denies('analytic_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $games = Game::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $analytic->load('game');

        return view('admin.analytics.edit', compact('games', 'analytic'));
    }

    public function update(UpdateAnalyticRequest $request, Analytic $analytic)
    {
        $analytic->update($request->all());

        return redirect()->route('admin.analytics.index');
    }

    public function show(Analytic $analytic)
    {
        abort_if(Gate::denies('analytic_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $analytic->load('game');

        return view('admin.analytics.show', compact('analytic'));
    }

    public function destroy(Analytic $analytic)
    {
        abort_if(Gate::denies('analytic_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $analytic->delete();

        return back();
    }

    public function massDestroy(MassDestroyAnalyticRequest $request)
    {
        Analytic::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
