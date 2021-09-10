<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\User;

class ContactFormController extends Controller
{
    public function index()
    {
        
        $users = User::all();
        /* foreach ($users as $user) 
        {
            dd($user->last_name);
        } */
        return view('auth.login');//admin wäre die standard laravel seite
    }


}
