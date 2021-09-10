<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\Entry as EntryResource;
use App\Http\Resources\Answer as AnswerResource;
use App\Entry;
use App\Answer;
use Validator;
use App\Helpers\Str;
use App\Mail\SuccessMail;
use App\Mail\ResponsibleMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;


class AnswerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return EntryResource::collection(Entry::all());
        //return AnswersResource::collection(Answer::all());
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
        $entryUpdateObject = $request->input();
        $entryUpdate = $entryUpdateObject['entryUpdate'];
        $entryAnswer = $entryUpdateObject['entryAnswer'];
        //$entryUpdate = $entryUpdate['entryUpdate']; 

        $test = 'test';
        Entry::where('ticketnumber', $entryUpdate['ticketnumber'])
               ->update( array('status_id'=>3) ); 
        $entry = Entry::where('ticketnumber', $entryUpdate['ticketnumber'])
                        ->first();
        echo $entry;
        Answer::create([
            'entry_id' => $entry->id,
            'user_id' => 1,
            'answer_text' => $entryAnswer,
        ]);


        $now = Carbon::now()->subDays(2);
        $now = $now->toDateTimeString();
        
        Answer::join('entries', 'entries.id', '=', 'answers.entry_id')
                ->where('entries.status_id', 3)
                ->where('answers.created_at', '<', $now)
                ->delete();
        Entry::where('status_id', 3)
               ->where('created_at', '<', $now)
               ->delete();


        //return $entryUpdate;
        $entryUpdate = (object) $entryUpdate;
        if ($test == 'test') {
            return new EntryResource($entryUpdate);
        }
        else {
            return false;
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
