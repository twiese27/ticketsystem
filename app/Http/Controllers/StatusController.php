<?php

namespace App\Http\Controllers;

use App\Http\Resources\Entry as EntryResource;
use App\Entry;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     *//* 
    public function __construct()
    {
        $this->middleware('auth');
    } */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $name = $request->path();
        if (strlen ( $name ) == 17)
        {
            //$name = $request->path();
            $ticketnumber = substr ( $name, 7, 10);
            //dd($ticketnumber);
            
            if (Entry::select('link')
                ->where('ticketnumber', $ticketnumber)
                ->first() == true)
            {
                //dd('richtig');
                return view('status');
            }
            else 
            {
                dd('falsch');
            }
        }
        else {
            dd('falsch2');
        }
        
    }
}
