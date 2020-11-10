<?php

use App\Repositories\Contracts\ProductRepository;
use App\Repositories\Eloquent\ProductRepositoryEloquent;
use Illuminate\Database\Migrations\Migration;

class FixDiscountPriceInProductsTable extends Migration
{
    public function up()
    {
        /** @var ProductRepository $repository */
        $repository = app(ProductRepositoryEloquent::class);
        $repository->updateWhere(
            ['discount_price' => 0],
            ['discount_price' => null]
        );
    }

    public function down()
    {
    }
}
