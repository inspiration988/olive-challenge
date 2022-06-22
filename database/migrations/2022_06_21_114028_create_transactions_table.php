<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->engine = "InnoDB"; // engine for transaction support

            $table->bigIncrements('id')->unsigned();
            $table->bigInteger('wallet_id')->unsigned();
            $table->decimal('amount',9,3);
            $table->enum('type', ['withdraw' ,'deposit']);
            $table->timestamps();
            $table->uuid('refrence_id')->nullable();

            // Relations
            $table->foreign('wallet_id')->references('id')->on('user_wallet');

            // Index
            /**
             * @todo define index fields
             * attention with query and searches
             * I suggest define this indexes : (type, wallet_id)
             */

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
