<?php

class UserController extends BaseController {

    /**
     * Create new API key for logged in user
     * @return void
     */
    public function resetAPIKey()
    {
        $user = User::find( Auth::id() );

        $key = Str::random(50);

        $user->api_key = $key;
        $user->save();

        return Redirect::route('front.settings');

    }

    /**
     * Close Account of logged in user
     * @return void
     */
    public function closeAccount()
    {
        //Get the user
        $user = User::find( Auth::id() );

        //Get logs
        $logs = APILog::where('user_id', '=', $user->id)->get();

        foreach($logs as $log) {
            //Delete the file
            $path = public_path(Config::get('api.storage_path').$log->images);

            File::delete($path);

            //Delete DB Entry
            $log->delete();
        }

        $user->delete();

        Slack::sendMessage('User deleted');

        return Redirect::route('oauth.logout');

    }

}
