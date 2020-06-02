<?php

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(Sale::class,500)->create();
        
        /**
         * VENTA UNO
         */
        DB::table('sales')->insert([
            'code'      => 'V-1909261-1',
            'date'      => '2019-09-26',
            'user_id'   => 1,
            'client'    => 'Cliente Uno',
            'total'      => 80,
            'description' => 'Venta al primer cliente'
        ]);
        
        DB::table('detail_sales')->insert([
            'code'          => 'V-1909261-1.AINCXC',
            'sale_code' => 'V-1909261-1',
            'product_code'  => 'AINCXC',
            'price_unit'    => 10,
            'quantity'      => 5
        ]);
        DB::table('detail_sales')->insert([
            'code'          => 'V-1909261-1.HFT3DXU',
            'sale_code' => 'V-1909261-1',
            'product_code'  => 'HFT3DXU',
            'price_unit'    => 10,
            'quantity'      => 1
        ]);
        DB::table('detail_sales')->insert([
            'code'          => 'V-1909261-1.AZUDXU',
            'sale_code' => 'V-1909261-1',
            'product_code'  => 'AZUDXU',
            'price_unit'    => 10,
            'quantity'      => 2
        ]);
        
        /**
         * VENTA DOS
         */
        DB::table('sales')->insert([
            'code'      => 'V-1909251-2',
            'date'      => '2019-08-25',
            'user_id'   => 1,
            'client'  => 'Cliente dos',
            'total'     => 270,
            'description' => 'Venta al segundo Cliente'
        ]);
        
        DB::table('detail_sales')->insert([
            'code'          => 'V-1909251-2.AINCXC',
            'sale_code' => 'V-1909251-2',
            'product_code'  => 'AINCXC',
            'price_unit'    => 100,
            'quantity'      => 2
        ]);
        DB::table('detail_sales')->insert([
            'code'          => 'V-1909251-2.HFT3DXU',
            'sale_code' => 'V-1909251-2',
            'product_code'  => 'HFT3DXU',
            'price_unit'    => 10,
            'quantity'      => 3
        ]);
        DB::table('detail_sales')->insert([
            'code'          => 'V-1909251-2.AZUDXU',
            'sale_code' => 'V-1909251-2',
            'product_code'  => 'AZUDXU',
            'price_unit'    => 10,
            'quantity'      => 4
        ]);
        /**
         * VENTA TRES
         */
        DB::table('sales')->insert([
            'code'      => 'V-1909241-3',
            'date'      => '2019-09-24',
            'user_id'   => 1,
            'client'  => 'Cliente Tres',
            'total'     => 40,
            'description' => 'Venta al tercer Cliente'
        ]);
        
        DB::table('detail_sales')->insert([
            'code'          => 'V-1909241-3.AINCXC',
            'sale_code' => 'V-1909241-3',
            'product_code'  => 'AINCXC',
            'price_unit'    => 10,
            'quantity'      => 2
        ]);
        DB::table('detail_sales')->insert([
            'code'          => 'V-1909241-3.HFT3DXU',
            'sale_code' => 'V-1909241-3',
            'product_code'  => 'HFT3DXU',
            'price_unit'    => 10,
            'quantity'      => 2
        ]);
        /**
         * VENTA CUATRO
         */
        DB::table('sales')->insert([
            'code'      => 'V-1908241-4',
            'date'      => '2019-08-24',
            'user_id'   => 1,
            'client'  => 'Cliente cuatro',
            'total'     => 60,
            'description' => 'Venta al cuarto Cliente'
        ]);
        
        DB::table('detail_sales')->insert([
            'code'          => 'V-1908241-4.AINCXC',
            'sale_code' => 'V-1908241-4',
            'product_code'  => 'AINCXC',
            'price_unit'    => 10,
            'quantity'      => 3
        ]);
        DB::table('detail_sales')->insert([
            'code'          => 'V-1908241-4.HFT3DXU',
            'sale_code' => 'V-1908241-4',
            'product_code'  => 'HFT3DXU',
            'price_unit'    => 10,
            'quantity'      => 3
        ]);
        
        /**
         * VENTA CINCO
         */
        DB::table('sales')->insert([
            'code'      => 'V-1907241-5',
            'date'      => '2019-07-24',
            'user_id'   => 1,
            'client'  => 'Cliente Quinto',
            'total'     => 80,
            'description' => 'Venta al quinto Cliente'
        ]);
        
        DB::table('detail_sales')->insert([
            'code'          => 'V-1907241-5.AINCXC',
            'sale_code' => 'V-1907241-5',
            'product_code'  => 'AINCXC',
            'price_unit'    => 20,
            'quantity'      => 2
        ]);
        DB::table('detail_sales')->insert([
            'code'          => 'V-1907241-5.HFT3DXU',
            'sale_code' => 'V-1907241-5',
            'product_code'  => 'HFT3DXU',
            'price_unit'    => 20,
            'quantity'      => 2
        ]);
        
        
        /***
         * ACTUALIZANDO QUANTITY PRODUCTOS
         */
        $product = Product::findOrFail('AINCXC');
        $product->stock = 2476;
        $product->save();
        $product = Product::findOrFail('HFT3DXU');
        $product->stock = 1329;
        $product->save();
        $product = Product::findOrFail('AZUDXU');
        $product->stock = 74;
        $product->save();
        
        
        DB::table('balances')->insert([
           'date' => '2019-07-01',
            'product_code'  => 'AINCXC',
            'balance'   => 1598
        ]);
        DB::table('balances')->insert([
            'date' => '2019-08-01',
            'product_code'  => 'AINCXC',
            'balance'   => 587
        ]);
        DB::table('balances')->insert([
            'date' => '2019-09-01',
            'product_code'  => 'AINCXC',
            'balance'   => 291
        ]);
        DB::table('balances')->insert([
            'date' => '2019-07-01',
            'product_code'  => 'HFT3DXU',
            'balance'   => 1048
        ]);
        DB::table('balances')->insert([
           'date' => '2019-08-01',
            'product_code'  => 'HFT3DXU',
            'balance'   => 37
        ]);
        DB::table('balances')->insert([
           'date' => '2019-09-01',
            'product_code'  => 'HFT3DXU',
            'balance'   => 249
        ]);
         DB::table('balances')->insert([
           'date' => '2019-09-01',
            'product_code'  => 'AZUDXU',
            'balance'   => 74
        ]);
        
    }
}
