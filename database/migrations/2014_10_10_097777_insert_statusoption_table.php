<?php

use App\Statusoption;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertStatusoptionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Statusoption::create([
            'status' => 'Offen'
        ]);
        Statusoption::create([
            'status' => 'In Arbeit'
        ]);
        Statusoption::create([
            'status' => 'Fertig-Geschlossen'
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
