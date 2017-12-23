<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CollectionsCards extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('card_collection', function (Blueprint $table) {
            $table->integer('card_id')->unsigned();
            $table->integer('collection_id')->unsigned();
            $table->boolean('knows')->default(0);
            $table->foreign('collection_id')->references('id')->on('collections')->onDelete('CASCADE');
            $table->foreign('card_id')->references('id')->on('cards')->onDelete('CASCADE');
        });
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
