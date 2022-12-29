<?php

namespace App\Http\Controllers\Auth;

use App\Models\Activities;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;


class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }
    public function registration()
    {
        return view('auth.registration');
    }
    public function postLogin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('personaldashboard')
                ->withSuccess('You have Successfully loggedin');
        } else {
            Session::flash('message', 'Incorrect username or password');
            Session::flash('alert-class', 'alert-danger');
        }

        return redirect("/")->withSuccess('Oppes! You have entered invalid credentials');
    }
    public function postRegistration(Request $request)
    {
        $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'username' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("dashboard")->withSuccess('Great! You have Successfully registered');
    }
    public function personaldashboard()
    {
        if (Auth::check()) {
            $activities = Activities::select('id', 'currentUser', 'created_at', 'updatedBy', 'updated_at', 'SMSCount', 'status', 'remarks')
                ->where('currentUser', '=', Auth::user()->username)->orderBy('updated_at', 'DESC')->get();
            return view('activities.personaldashboard')->with('activities', $activities);
        }

        //  return redirect("login")->withSuccess('Opps! You do not have access');
    }
    public function create(array $data)
    {
        return User::create([
            'firstName' => $data['firstName'],
            'lastName' => $data['lastName'],
            'username' => $data['username'],
            'password' => Hash::make($data['password'])
        ]);
    }
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return Redirect('/');
    }
}