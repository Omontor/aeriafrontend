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
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Redirect;


class CustomKeyController extends Controller
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

        return view('admin.customKeys.index',compact('analytics'));
    }

    public function create()
    {
       
$client = new Client([
    'base_uri' => env('REMOTE_URL'),
    'timeout'  => 2.0,
    'verify' => false

]);

    $response = $client->request('GET', '/api/AeriaAnalytics/AllAnalytics');
    $analytics = json_decode($response->getBody()->getContents());



        return view('admin.customKeys.create', compact('analytics'));
    }


    public function store(Request $request)
    {

                $client = new Client([
                        'base_uri' => env('REMOTE_URL'),
                        'timeout'  => 2.0,
                        'verify' => false

                    ]);
            try { 
            $response = $client->request('POST', '/api/AeriaCustomKeys/create', 
                ['json' => 
                    [
                    'id'=> 0,   
                    'name' => $request->name,
                    'aid' => $request->analytic_id,  
                    ]

                 ]);
            return redirect::route('admin.custom-keys.index')->with('success', 'Custom Key Created Successfully');
            } 
            catch (Exception $e) {
                
                 return redirect::route('admin.custom-keys.index')->with('error', $e);

            }
 

        
    }



    public function view ($index){

  $client = new Client([
            'base_uri' => env('REMOTE_URL'),
            'timeout'  => 2.0,
            'verify' => false

        ]);

        $response = $client->request('GET', '/api/AeriaCustomKeys/AllKeys/'.$index);
        $keys = json_decode($response->getBody()->getContents());
        return view('admin.customKeys.view', compact('keys'));

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
