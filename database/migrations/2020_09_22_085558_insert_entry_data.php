<?php

use App\Entry;
use App\Category;
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
            'ticketnumber' => '012DDD78JT',

            'first_name' => 'René',

            'last_name' => 'Spengel',

            'customer_number' => '00020',

            'email' => 'rené.spengel@vierol.de',

            'category_id' => 1,

            'text' => 'Hallo, ich habe ein Problem mit meinem Rechner, könnt ihr mir bitte helfen?',

            'status_id' => 1,

            'link' => 'https://www.ticketsystem.de/AAAAAAAAA1'
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
