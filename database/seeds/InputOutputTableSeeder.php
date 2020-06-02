<?php

use Illuminate\Database\Seeder;

class InputOutputTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(InputOutput::class, 500)->create();
        DB::table('inputs_outputs')->insert([
            'code'      => 'P-1907021-1',
            'date'      => '2019-06-21',
            'type'      => 'input',
            'user_id'   => 1,
            'product_code'  => 'AINCXC',
            'operation' => 'Inventario inicial inicio de sistema',
            'quantity'  => 1500
        ]);
        DB::table('inputs_outputs')->insert([
            'code'      => 'P-1907021-2',
            'date'      => '2019-06-21',
            'type'      => 'input',
            'user_id'   => 1,
            'product_code'  => 'HFT3DXU',
            'operation' => 'Inventario inicial inicio de sistema',
            'quantity'  => 1000
        ]);
        DB::table('inputs_outputs')->insert([
            'code'      => 'P-1909026-1',
            'date'      => '2019-07-21',
            'type'      => 'input',
            'user_id'   => 1,
            'product_code'  => 'AINCXC',
            'operation' => 'Movimientos varios',
            'quantity'  => 500
        ]);
        DB::table('inputs_outputs')->insert([
            'code'      => 'P-1909026-2',
            'date'      => '2019-08-21',
            'type'      => 'input',
            'user_id'   => 1,
            'product_code'  => 'HFT3DXU',
            'operation' => 'Movimientos varios',
            'quantity'  => 100
        ]);
        DB::table('inputs_outputs')->insert([
            'code'      => 'P-1908021-3',
            'date'      => '2019-07-21',
            'type'      => 'output',
            'user_id'   => 1,
            'product_code'  => 'AINCXC',
            'operation' => 'Perdida por merma',
            'quantity'  => 10
        ]);
        DB::table('inputs_outputs')->insert([
            'code'      => 'P-1908021-3',
            'date'      => '2019-07-21',
            'type'      => 'output',
            'user_id'   => 1,
            'product_code'  => 'HFT3DXU',
            'operation' => 'Perdida por merma',
            'quantity'  => 10
        ]);
    }
}
