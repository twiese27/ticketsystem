<?php

use App\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Category::create([
            'topic' => 'technischer Support'
        ]);
        Category::create([
            'topic' => 'Rechnung'
        ]);
        Category::create([
            'topic' => 'Bestellung'
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
