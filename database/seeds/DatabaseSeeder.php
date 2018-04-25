<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->call(Product_StoreTableSeeder::class);
      $this->call(ProductsTableSeeder::class);
      $this->call(StoresTableSeeder::class);
      $this->call(ReviewsTableSeeder::class);
    }
}
