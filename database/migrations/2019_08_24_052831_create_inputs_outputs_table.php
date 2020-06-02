<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInputsOutputsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inputs_outputs', function (Blueprint $table) {
            $table->string('code');
            $table->date('date');
            $table->string('operation');
            $table->bigInteger('user_id')->unsigned();
            $table->string('product_code');
            $table->enum('type',['input','output','purchase','sale']);
            $table->bigInteger('quantity');
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
        Schema::dropIfExists('inputs_outputs');
    }
}
