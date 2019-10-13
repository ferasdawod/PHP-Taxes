<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaxEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tax_entries', function (Blueprint $table) {
            $table->increments('id');

            $table->decimal('amount', 15, 4)->default(0);

            $table->unsignedInteger('county_id');
            $table->foreign('county_id')->references('id')->on('counties');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tax_entries');
    }
}
