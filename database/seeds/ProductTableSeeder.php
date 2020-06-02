<?php

use Carbon\Carbon;

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
           'code'           => 'AINCXC',
            'description'   => 'ACEITE INDIGO DE 4X5',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'CAJA',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('products')->insert([
           'code'           => 'AINQXN',
            'description'   => 'ACEITE INDIGO DE 15X900',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'CAJA',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('products')->insert([
           'code'           => 'AGOCXC',
            'description'   => 'ACEITE GRANO DE ORO DE 4X5',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'CAJA',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('products')->insert([
           'code'           => 'AGOQXN',
            'description'   => 'ACEITE GRANO DE ORO DE 15X900',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'CAJA',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('products')->insert([
           'code'           => 'HFT3DXU',
            'description'   => 'HARINA FLORENCIA 000 10X1',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'PAQUETE',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('products')->insert([
           'code'           => 'HFT4DXU',
            'description'   => 'HARINA FLORENCIA 0000 10X1',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'PAQUETE',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('products')->insert([
           'code'           => 'HFT4CXC',
            'description'   => 'HARINA FLORENCIA 0000 4X5',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'PAQUETE',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('products')->insert([
           'code'           => 'AZUDXU',
            'description'   => 'AZUCAR 10X1',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'FARDO',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('products')->insert([
           'code'           => 'AZUXC',
            'description'   => 'AZUCAR 50 KG.',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'BOLSA',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('products')->insert([
           'code'           => 'GRAVXQ',
            'description'   => 'GRASA DE 20X500',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'CAJA',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('products')->insert([
           'code'           => 'GRADXQ',
            'description'   => 'GRASA DE 10X500',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'CAJA',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('products')->insert([
           'code'           => 'GRALAT',
            'description'   => 'GRASA EN LATA',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'LATA',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        
        DB::table('products')->insert([
           'code'           => 'WKYL',
            'description'   => 'WHISKY DE LITRO',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'CAJA',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        
        DB::table('products')->insert([
           'code'           => 'WKYXV',
            'description'   => 'WHISKY X24 UNIDADES',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'CAJA',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        
        DB::table('products')->insert([
           'code'           => 'CERAZL',
            'description'   => 'CEREAL AZUL',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'CAJA',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('products')->insert([
           'code'           => 'CERAMA',
            'description'   => 'CEREAL AMARILLO',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'CAJA',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        
        DB::table('products')->insert([
           'code'           => 'CERXDC',
            'description'   => 'CEREAL DE 2.5 KG.',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'BOLSA',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('products')->insert([
           'code'           => 'HRT3DXU',
            'description'   => 'HARINA REINAHARINA 000 10X1',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'BOLSA',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('products')->insert([
           'code'           => 'HEXV',
            'description'   => 'HARINA ESTRELLA X25',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'BOLSA',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('products')->insert([
           'code'           => 'HEXC',
            'description'   => 'HARINA ESTRELLA X50',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'BOLSA',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        
        DB::table('products')->insert([
           'code'           => 'AZXC',
            'description'   => 'ARROZ X50',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'BOLSA',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        
        DB::table('products')->insert([
           'code'           => 'AZDXU',
            'description'   => 'ARROZ 10X1',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'FARDO',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        
        DB::table('products')->insert([
           'code'           => 'TRIVXQ',
            'description'   => 'TRIGUILLO 20X500',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'BOLSA',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('products')->insert([
           'code'           => 'TRIDXM',
            'description'   => 'TRIGUILLO 10X1000',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'BOLSA',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('products')->insert([
           'code'           => 'SIDSXN',
            'description'   => 'SIDRA 6X900',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'CAJA',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('products')->insert([
           'code'           => 'JUGXO',
            'description'   => 'JUGO X8 UNIDADES DE LITRO',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'CAJA',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
        DB::table('products')->insert([
           'code'           => 'JUGXD',
            'description'   => 'JUGO X18 UNIDADES DE 200 CC',
            'stock'         => 0,
            'price'         => 100,
            'unit'          => 'CAJA',
            'status'        => 1,
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now()
        ]);
//        DB::table('products')->insert([
//            'code'          => '1111111111',
//            'description'   => 'GASEOSA COCA COLA BOTELLA DE 1 LITRO X 6 UNIDADES',
//            'stock'         => 0,
//            'price'         => 9000,
//            'unit'          => 'FARDO',
//            'status'        => 1,
//            'created_at'    => Carbon::now(),
//            'updated_at'    => Carbon::now()
//        ]);
//        DB::table('products')->insert([
//            'code'          => '2222222222',
//            'description'   => 'ACEITE FINO DE 1 LITRO X 4 UNIDADES',
//            'stock'         => 0,
//            'price'         => 10000,
//            'unit'          => 'CAJA',
//            'status'        => 1,
//            'created_at'    => Carbon::now(),
//            'updated_at'    => Carbon::now()
//        ]);
//        DB::table('products')->insert([
//            'code'          => '3333333333',
//            'description'   => 'HARINA DE MAIZ GLUTAN DE 100 KG.',
//            'stock'         => 0,
//            'price'         => 11000,
//            'unit'          => 'BOLSA',
//            'status'        => 1,
//            'created_at'    => Carbon::now(),
//            'updated_at'    => Carbon::now()
//        ]);
//        DB::table('products')->insert([
//            'code'          => '4444444444',
//            'description'   => 'ARROZ SUPREMO DE 1 KG. X 12 UNIDADES',
//            'stock'         => 0,
//            'price'         => 12000,
//            'unit'          => 'BOLSA',
//            'status'        => 1,
//            'created_at'    => Carbon::now(),
//            'updated_at'    => Carbon::now()
//        ]);
//        DB::table('products')->insert([
//            'code'          => '5555555555',
//            'description'   => 'ARROZ SUPREMO DE 50 KG.',
//            'stock'         => 0,
//            'price'         => 13000,
//            'unit'          => 'BOLSA',
//            'status'        => 1,
//            'created_at'    => Carbon::now(),
//            'updated_at'    => Carbon::now()
//        ]);
//        DB::table('products')->insert([
//            'code'          => '6666666666',
//            'description'   => 'FIDEO ESTIR DE 56 KG.',
//            'stock'         => 0,
//            'price'         => 15000,
//            'unit'          => 'BOLSA',
//            'status'        => 1,
//            'created_at'    => Carbon::now(),
//            'updated_at'    => Carbon::now()
//        ]);
//        DB::table('products')->insert([
//            'code'          => '7777777777',
//            'description'   => 'HARINA DE TRIGO GLUTAN TIPO 0000 DE 56 KG.',
//            'stock'         => 0,
//            'price'         => 14000,
//            'unit'          => 'BOLSA',
//            'status'        => 1,
//            'created_at'    => Carbon::now(),
//            'updated_at'    => Carbon::now()
//        ]);
//        DB::table('products')->insert([
//            'code'          => '8888888888',
//            'description'   => 'FIDEO  TIPO FUSILI DE 56 KG.',
//            'stock'         => 0,
//            'price'         => 15000,
//            'unit'          => 'BOLSA',
//            'status'        => 1,
//            'created_at'    => Carbon::now(),
//            'updated_at'    => Carbon::now()
//        ]);
//        factory(Product::class, 500)->create();
    }
}
