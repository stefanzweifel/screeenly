<?php namespace Screeenly\Http\Controllers;

use Auth, Redirect, Config, File;

use Screeenly\APILog;

class UserController extends Controller {

    /**
     * Create new API key for logged in user
     * @return Illuminate\Http\RedirectResponse
     */
    public function resetAPIKey()
    {
        $user = Auth::user();
        $user->api_key = str_random(50);
        $user->save();

        return Redirect::route('front.dashboard');

    }

    /**
     * Close Account of logged in user
     * @return Illuminate\Http\RedirectResponse
     */
    public function closeAccount()
    {
        $user = Auth::user();
        $logs = APILog::where('user_id', '=', $user->id)->get();

        foreach($logs as $log) {

            $path = public_path(Config::get('api.storage_path').$log->images);
            File::delete($path);

            $log->delete();
        }

        $user->delete();

        // Slack::sendMessage('User deleted');

        return Redirect::route('oauth.logout');

    }

}
