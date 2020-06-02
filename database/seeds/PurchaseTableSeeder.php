<?php

use App\Models\Purchase;
use Illuminate\Database\Seeder;

class PurchaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(Purchase::class, 500)->create();
        /**
         * COMPRA UNO
         */
        DB::table('purchases')->insert([
            'code'      => 'C-1909261-1',
            'date'      => '2019-09-26',
            'user_id'   => 1,
            'invoice'   => 1111111111,
            'taxe_iva'  => 10.5,
            'taxe_percep_iva'   => 1.5,
            'taxe_iibb_salta'   => 3.6,
            'taxe_municipal'    => 2,
            'supplier'  => 'Proveedor Uno',
            'total'     => 1900,
            'description' => 'Compra al primer proveedor'
        ]);
        
        DB::table('detail_purchases')->insert([
            'code'          => 'C-1909261-1.AINCXC',
            'purchase_code' => 'C-1909261-1',
            'product_code'  => 'AINCXC',
            'import'    => 10,
            'quantity'      => 100
        ]);
        DB::table('detail_purchases')->insert([
            'code'          => 'C-1909261-1.HFT3DXU',
            'purchase_code' => 'C-1909261-1',
            'product_code'  => 'HFT3DXU',
            'import'    => 10,
            'quantity'      => 50
        ]);
        DB::table('detail_purchases')->insert([
            'code'          => 'C-1909261-1.AZUDXU',
            'purchase_code' => 'C-1909261-1',
            'product_code'  => 'AZUDXU',
            'import'    => 10,
            'quantity'      => 40
        ]);
        /**
         * COMPRA DOS
         */
        DB::table('purchases')->insert([
            'code'      => 'C-1909251-2',
            'date'      => '2019-09-25',
            'user_id'   => 1,
            'invoice'   => 2222222222,
            'taxe_iva'  => 10.5,
            'taxe_percep_iva'   => 1.5,
            'taxe_iibb_salta'   => 3.6,
            'taxe_municipal'    => 2,
            'supplier'  => 'Proveedor dos',
            'total'     => 10900,
            'description' => 'Compra al segundo proveedor'
        ]);
        
        DB::table('detail_purchases')->insert([
            'code'          => 'C-1909251-2.AINCXC',
            'purchase_code' => 'C-1909251-2',
            'product_code'  => 'AINCXC',
            'import'    => 100,
            'quantity'      => 100
        ]);
        DB::table('detail_purchases')->insert([
            'code'          => 'C-1909251-2.HFT3DXU',
            'purchase_code' => 'C-1909251-2',
            'product_code'  => 'HFT3DXU',
            'import'    => 10,
            'quantity'      => 50
        ]);
        DB::table('detail_purchases')->insert([
            'code'          => 'C-1909251-2.AZUDXU',
            'purchase_code' => 'C-1909251-2',
            'product_code'  => 'AZUDXU',
            'import'    => 10,
            'quantity'      => 40
        ]);
        /**
         * COMPRA TRES
         */
        DB::table('purchases')->insert([
            'code'      => 'C-1909241-3',
            'date'      => '2019-09-24',
            'user_id'   => 1,
            'invoice'   => 3333333333,
            'taxe_iva'  => 10.5,
            'taxe_percep_iva'   => 1.5,
            'taxe_iibb_salta'   => 3.6,
            'taxe_municipal'    => 2,
            'supplier'  => 'Proveedor Tres',
            'total'     => 1500,
            'description' => 'Compra al tercer proveedor'
        ]);
        
        DB::table('detail_purchases')->insert([
            'code'          => 'C-1909241-3.AINCXC',
            'purchase_code' => 'C-1909241-3',
            'product_code'  => 'AINCXC',
            'import'    => 10,
            'quantity'      => 100
        ]);
        DB::table('detail_purchases')->insert([
            'code'          => 'C-1909241-3.HFT3DXU',
            'purchase_code' => 'C-1909241-3',
            'product_code'  => 'HFT3DXU',
            'import'    => 10,
            'quantity'      => 50
        ]);
        /**
         * COMPRA CUATRO
         */
        DB::table('purchases')->insert([
            'code'      => 'C-1908241-4',
            'date'      => '2019-08-24',
            'user_id'   => 1,
            'invoice'   => 4444444444,
            'taxe_iva'  => 10.5,
            'taxe_percep_iva'   => 1.5,
            'taxe_iibb_salta'   => 3.6,
            'taxe_municipal'    => 2,
            'supplier'  => 'Proveedor cuatro',
            'total'     => 1500,
            'description' => 'Compra al cuarto proveedor'
        ]);
        
        DB::table('detail_purchases')->insert([
            'code'          => 'C-1908241-4.AINCXC',
            'purchase_code' => 'C-1908241-4',
            'product_code'  => 'AINCXC',
            'import'    => 10,
            'quantity'      => 100
        ]);
        DB::table('detail_purchases')->insert([
            'code'          => 'C-1908241-4.HFT3DXU',
            'purchase_code' => 'C-1908241-4',
            'product_code'  => 'HFT3DXU',
            'import'    => 10,
            'quantity'      => 50
        ]);
        
        /**
         * COMPRA CINCO
         */
        DB::table('purchases')->insert([
            'code'      => 'C-1907241-5',
            'date'      => '2019-07-24',
            'user_id'   => 1,
            'invoice'   => 5555555555,
            'taxe_iva'  => 10.5,
            'taxe_percep_iva'   => 1.5,
            'taxe_iibb_salta'   => 3.6,
            'taxe_municipal'    => 2,
            'supplier'  => 'Proveedor Quinto',
            'total'     => 1500,
            'description' => 'Compra al quinto proveedor'
        ]);
        
        DB::table('detail_purchases')->insert([
            'code'          => 'C-1907241-5.AINCXC',
            'purchase_code' => 'C-1907241-5',
            'product_code'  => 'AINCXC',
            'import'    => 10,
            'quantity'      => 100
        ]);
        DB::table('detail_purchases')->insert([
            'code'          => 'C-1907241-5.HFT3DXU',
            'purchase_code' => 'C-1907241-5',
            'product_code'  => 'HFT3DXU',
            'import'    => 10,
            'quantity'      => 50
        ]);
    }
}
