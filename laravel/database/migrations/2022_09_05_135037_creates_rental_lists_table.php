<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatesRentalListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentalLists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('item_id');
            $table->date('lending_date');
            $table->date('back_date')->nullable();;
            $table->unsignedBigInteger('member_id');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');;    
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rentalLists');
    }
}
