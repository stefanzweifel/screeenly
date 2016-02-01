<?php

namespace Screeenly\Http\Controllers;

use Config;
use File;
use Session;
use Slack;
use Screeenly\ApiLog;
use Screeenly\Http\Requests\StoreEmailRequest;
use Illuminate\Http\Request;
use Screeenly\Http\Requests;
use Screeenly\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Close Account of logged in user.
     *
     * @return Illuminate\Http\RedirectResponse
     */
    public function closeAccount()
    {
        $user = auth()->user();
        $logs = ApiLog::where('user_id', $user->id)->get();

        foreach ($logs as $log) {
            $path = public_path(Config::get('api.storage_path').$log->images);
            File::delete($path);

            $log->delete();
        }

        foreach ($user->apikeys as $key) {
            $key->delete();
        }

        $user->delete();

        Slack::send('User deleted');

        return redirect()->route('oauth.logout')->withSuccess("Youre account has been closed. Goodbye :)");
    }

    /**
     * Store User Email if not given by OAuth.
     *
     * @param StoreEmailRequest $request
     *
     * @return Illuminate\Http\RedurectResponse
     */
    public function storeEmail(StoreEmailRequest $request)
    {
        $user = auth()->user();
        $user->email = $request->get('email');
        $user->save();

        $requestedPath = Session::get('requestedPath', '/settings');

        return redirect($requestedPath)->withMessage("Your email has been updated.");
    }
}
