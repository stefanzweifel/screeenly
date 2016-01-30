<?php

namespace Screeenly\Http\Controllers;

use Illuminate\Http\Request;
use Screeenly\Http\Requests;
use Screeenly\Http\Controllers\Controller;
use Screeenly\ApiKey;
use Screeenly\Http\Requests\ApiKeyRequest;

class ApiKeysController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(ApiKeyRequest $request)
    {
        $key = new ApiKey();
        $key->name = $request->get('name');
        $key->key = $key->generateKey();
        $key->user()->associate(auth()->user());

        $key->save();

        return back()->withMessage("New API key added!");
    }

    /**
     * Display the specified resource.
     *
     * @param  ApiKey $apikey
     * @return Response
     */
    public function show(ApiKey $apikey)
    {
        return view('app.apikeys.show', compact('apikey'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  ApiKey $apikey
     * @return Response
     */
    public function edit(ApiKey $apikey)
    {
        return view('app.apikeys.edit', compact('apikey'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ApiKey $apikey
     * @return Response
     */
    public function update(ApiKeyRequest $request, ApiKey $apikey)
    {
        $apikey->update($request->all());

        return redirect()->route('app.dashboard')->withMessage("Key {$apikey->name} saved!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  ApiKey $apikey
     * @return Response
     */
    public function destroy(ApiKey $apikey)
    {
        $apikey->delete();

        return redirect()->back()->withMessage("API Key deleted");
    }
}
