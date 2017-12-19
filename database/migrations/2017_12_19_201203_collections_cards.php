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
        Schema::create('collections_cards', function (Blueprint $table) {
            $table->integer('collection_id')->unsigned();
            $table->integer('card_id')->unsigned();
            $table->boolean('knows')->default(0);
            $table->primary(['collection_id','card_id']);
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
