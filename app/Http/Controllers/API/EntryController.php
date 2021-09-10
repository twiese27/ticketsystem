<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Answer as AnswerResource;
use App\Http\Resources\Entry as EntryResource;
use App\Answer;
use App\Entry;
use Validator;
use App\Helpers\Str;
use App\Mail\SuccessMail;
use App\Mail\ResponsibleMail;
use Illuminate\Support\Facades\Mail;


class EntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EntryResource::collection(Entry::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $formData = $request->input(); 
        $validateData = $formData['formData'];
        
        $first_name = $validateData['name'];
        $last_name = $validateData['name2'];
        $customernumber = $validateData['customernumber'];
        $email = $validateData['email'];
        $topic = $validateData['topic'];
        $text = $validateData['text'];
        
        if 
        (strlen($first_name) <= 3
        OR !is_string($first_name)
        OR strpbrk($first_name, '1234567890')

        OR strlen($last_name) == 0
        OR !is_string($last_name)
        OR strpbrk($last_name, '1234567890')

        OR strlen($customernumber) != 5 
        OR !is_String($customernumber)
        OR !strpbrk($customernumber, '1234567890')

        OR strlen($email) == 0 
        OR !filter_var($email, FILTER_VALIDATE_EMAIL)

        OR strlen($topic) == 0
        OR strlen($text) <= 24 ) {
            return false;

            //war dazu gedacht alte einträge zu löschen
            //Entry::where('updated_at', );
            /* Entry::selectRaw('*, datediff(updated_at, now())')
                ->whereRaw('datediff(updated_at, now()) > ?', [-99])
                ->delete(); */
        }
        else {
            $ticketnumber = Str::uniqueAlphaNumericEntryString();

            $link = 'https://www.ticketsystem.loc/ticket/'.$ticketnumber;


            $entry = Entry::create([
                'ticketnumber' => $ticketnumber,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'customer_number' => $customernumber,
                'email' => $email,
                'category_id' => $topic,
                'text' => $text,
                'status_id' => 1,
                'link' => $link
            ]);



            /* Mail::to(1)
                ->send(new SuccessMail($entry));*/
                
                //dd(config('mail.recipients.' . $topic));
            Mail::to(config('mail.recipients.' . $topic))
                ->send(new ResponsibleMail($entry)); 

            Mail::to("tjade.wiese@vierol.de")
                ->send(new SuccessMail($entry)); 

            //$link = 'https://www.ticketsystem.loc/'.$ticketnumber;
            /* $links = Entry::select('link')
                    ->orderBy('created_at', 'ASC')
                    ->first()
                    /* ->pluck('link')->toArray() *//*;

            dd($links); */

            return new EntryResource($entry);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
