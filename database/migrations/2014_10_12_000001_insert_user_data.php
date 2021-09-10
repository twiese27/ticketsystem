<?php

use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertUserData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        User::create([
            'first_name' => 'Tjade',

            'last_name' => 'Wiese',

            'email' => 'tjade.wiese@vierol.de',

            'password' => '$2y$10$XtRyekYS0EYVdvxjHCvilu9yUAE44uTXWwz8AT7d4XbzDJlkLAYJ2'
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
