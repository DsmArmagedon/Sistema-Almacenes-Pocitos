<?php

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email'                 => 'daniel.r.sanchez.martinez@gmail.com',
            'username'              => 'DANIELS666',
            'first_name'            => 'daniel roberto',
            'last_name'             => 'sanchez martinez',
            'address'               => 'C. Cochabamba Nº 541',
            'phone'                 => '73489152',
            'password'              => bcrypt('daniel'),
            'status'                => 1,
            'role_id'               => 1,
            'company_position_id'   => 2,
            'created_at'            => Carbon::now(),
            'updated_at'            => Carbon::now()
        ]);
//        DB::table('users')->insert([
//            'email'                 => 'prueba@gmail.com',
//            'username'              => 'PRUEBAS111',
//            'first_name'            => 'prueba',
//            'last_name'             => 'sistema',
//            'address'               => 'C. Cochabamba Nº 541',
//            'phone'                 => '22222222',
//            'password'              => bcrypt('prueba'),
//            'status'                => 1,
//            'role_id'               => 1,
//            'company_position_id'   => 3,
//            'created_at'            => Carbon::now(),
//            'updated_at'            => Carbon::now()
//        ]);
//        $count = 100;
//        factory(User::class, $count)->create();
    }
}
