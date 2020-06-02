<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases', function (Blueprint $table) {
            $table->string('code')->unique();
            $table->date('date');
            $table->bigInteger('user_id')->unsigned();
            $table->string('supplier')->nullable();
            $table->string('invoice')->nullable();
            $table->float('taxe_iva',3,1)->nullable();
            $table->float('taxe_percep_iva',3,1)->nullable();
            $table->float('taxe_iibb_salta',3,1)->nullable();
            $table->float('taxe_municipal',3,1)->nullable();
            $table->float('total',20,2);
            $table->string('description');
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
        Schema::dropIfExists('purchases');
    }
}
