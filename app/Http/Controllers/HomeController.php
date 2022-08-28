<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function differentAccount(Request $request)
    {
        Auth::logout();
        Session::put('url.intended', $request->current_url);
        return redirect("login");

    }

    public function resetAuth(array $guards = null)
    {
        $guards = $guards ?: array_keys(config('auth.guards'));

        foreach ($guards as $guard) {
            $guard = $this->app['auth']->guard($guard);

            if ($guard instanceof \Illuminate\Auth\SessionGuard) {
                $guard->logout();
            }
        }

        $protectedProperty = new \ReflectionProperty($this->app['auth'], 'guards');
        $protectedProperty->setAccessible(true);
        $protectedProperty->setValue($this->app['auth'], []);
    }
}
