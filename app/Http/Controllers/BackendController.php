<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\User;

class BackendController extends Controller
{
    public function index()
    {

        $users = User::all();
        /* foreach ($users as $user)
        {
            dd($user->last_name);
        } */
        if (Auth::check()){
            return view('home');
        }
        else {
            return view('auth.login');
        }
    }


}
