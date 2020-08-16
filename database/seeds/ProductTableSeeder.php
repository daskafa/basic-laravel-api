<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::statement('SET FOREIGN_KEY_CHECKS=0');

      DB::statement("TRUNCATE TABLE products");
      factory(Product::class, 10)->create();

      DB::statement('SET FOREIGN_KEY_CHECKS=1');

    }
}
