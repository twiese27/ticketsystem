<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entries', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('ticketnumber', 10);
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->string('customer_number', 5);
            $table->string('email', 50);
            $table->unsignedBigInteger('category_id');
            $table->string('text', 250);
            $table->unsignedBigInteger('status_id')->default(1);
            $table->string('link', 100);
            $table->timestamps();

            //constraints
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('status_id')->references('id')->on('statusoptions');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entries');
    }
}
