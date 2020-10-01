<?php

use App\Entry;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertEntryData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Entry::create([
            'first_name' => 'René',

            'last_name' => 'Spengel',

            'customer_number' => '00020',

            'email' => 'rené.spengel@vierol.de',

            'topic' => 'technischer Support',

            'text' => 'Hallo, ich habe ein Problem mit meinem Rechner, könnt ihr mir bitte helfen?'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
