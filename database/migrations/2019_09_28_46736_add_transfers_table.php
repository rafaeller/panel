<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTransfersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('server_transfers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('old_server_id');
            $table->integer('new_node_id');
            $table->integer('new_allocation_id');
            $table->integer('new_server_id')->nullable();
            $table->integer('status')->default('1');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('server_transfers');
    }
}
