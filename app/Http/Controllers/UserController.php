<?php namespace Screeenly\Http\Controllers;

use Auth, Config, File, Session, Slack;

use Screeenly\APILog;
use Screeenly\Http\Requests\StoreEmailRequest;

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

        Session::flash('message', "Youre API key was resetet.");
        Session::flash('message_type', 'success');

        return redirect()->route('app.dashboard');
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

        Slack::send('User deleted');

        Session::flash('message', "Youre account has been closed. Goodbye :)");
        Session::flash('message_type', 'success');

        return redirect()->route('oauth.logout');
    }

    /**
     * Store User Email if not given by OAuth
     * @param  StoreEmailRequest $request
     * @return Illuminate\Http\RedurectResponse
     */
    public function storeEmail(StoreEmailRequest $request)
    {
        $user = Auth::user();
        $user->email = $request->get('email');
        $user->save();

        $requestedPath = Session::get('requestedPath', '/');

        \Session::flash('message', "Youre email has been updated.");
        \Session::flash('message_type', 'success');

        return redirect($requestedPath);
    }

}
