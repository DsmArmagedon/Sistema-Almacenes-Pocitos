<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_sales', function (Blueprint $table) {
            $table->string('code')->primary()->unique()->index();
            $table->string('sale_code');
            $table->string('product_code');
            $table->float('price_unit',12,2);
            $table->bigInteger('quantity');
            $table->timestamps();

            $table->foreign('sale_code')->references('code')->on('sales')->onUpdate('cascade');
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
        Schema::dropIfExists('detail_sales');
    }
}
