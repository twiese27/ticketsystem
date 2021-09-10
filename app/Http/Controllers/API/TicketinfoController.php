<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Statusoption as StatusoptionResource;
use App\Http\Resources\Entry as EntryResource;
use App\Statusoption;
use App\Entry;

class TicketinfoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return StatusoptionResource::collection(Statusoption::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $input = $request->input(); 
        $link = $input['formData'];

        $ticketnumber = substr( $link, 8, 10);

        

        if (Entry::select('*')
                    ->where('ticketnumber', $ticketnumber)
                   ->first() == true)
        {
            $entry = Entry::where('ticketnumber', $ticketnumber)
                            ->first();
            return new EntryResource($entry);
            
        }
        else 
        {
            dd('fehler');
        }

        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
