<?php

namespace Screeenly\Http\Controllers\App\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Screeenly\Http\Requests\SetupEmail;
use Screeenly\Models\User;

class EmailController extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Show View to store Email Address.
     * @param  Request $request
     * @return view
     */
    public function create(Request $request)
    {
        $provider_id = $request->provider_id;

        session(['provider_id' => $provider_id]);

        return view('screeenly::setup.email.create');
    }

    /**
     * Store Email Address to current logged in user.
     * @param  SetupEmail $request
     * @return Redirect
     */
    public function store(SetupEmail $request)
    {
        $user = $this->user->createNewUserFromGithub($request->email, session('provider_id'));

        auth()->login($user);

        return redirect('dashboard');
    }
}
