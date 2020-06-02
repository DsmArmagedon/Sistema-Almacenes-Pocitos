<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailPurchasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_purchases', function (Blueprint $table) {
            $table->string('code')->primary()->unique()->index();
            $table->string('purchase_code');
            $table->string('product_code');
            $table->float('import',18,2)->unsigned();
            $table->bigInteger('quantity')->unsigned();
            $table->timestamps();

            $table->foreign('purchase_code')->references('code')->on('purchases')->onUpdate('cascade');
            $table->foreign('product_code')->references('code')->on('products')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_purchases');
    }
}
