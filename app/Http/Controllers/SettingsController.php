<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Screeenly\Http\Requests\SetupEmail;

class SettingsController extends Controller
{
    /**
     * Show Settings Page.
     * @return View
     */
    public function show()
    {
        return view('app.settings');
    }

    /**
     * Update User Account.
     * @param  SetupEmail $request
     * @return Redirect
     */
    public function update(SetupEmail $request)
    {
        auth()->user()->update([
            'email' => $request->email,
        ]);

        $request->session()->flash('message', 'Account updated.');

        return redirect()->back();
    }

    /**
     * Delete Account and remove all remaining ApiLogs and ApiKeys.
     * @param  Request $request
     * @return Redirect
     */
    public function delete(Request $request)
    {
        $user = auth()->user();

        foreach ($user->apiLogs as $log) {
            // $path = public_path(Config::get('api.storage_path').$log->images);
            // File::delete($path);

            $log->delete();
        }

        foreach ($user->apiKeys as $key) {
            $key->delete();
        }

        auth()->logout();

        $user->delete();

        return redirect('/');
    }
}
