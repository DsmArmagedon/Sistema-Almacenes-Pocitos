<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);
        $this->call(CompanyPositionTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(ProductTableSeeder::class);
//        $this->call(PurchaseTableSeeder::class);
//        $this->call(SaleTableSeeder::class);
//        $this->call(InputOutputTableSeeder::class);
    }
}
