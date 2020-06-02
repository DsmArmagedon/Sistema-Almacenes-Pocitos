<?php

namespace App\Listeners;

use App\Events\DetailSaleCreatedUpdatedDeleted;
use App\Models\Balance;
use App\Models\Product;
use App\Repositories\DetailSaleRepository;

class UpdateQuantityStockProductSale
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  DetailSaleCreatedUpdatedDeleted  $event
     * @return void
     */
    public function handle(DetailSaleCreatedUpdatedDeleted $event)
    {
        $product = Product::findOrFail($event->productCode);
        $balance = Balance::getObjectBalance($product->code);
        switch($event->typeMethod) {
            case DetailSaleRepository::CREATED:
                $balance->balance -= $event->newQuantity;
                $product->stock -= $event->newQuantity;
            break;
            case DetailSaleRepository::UPDATED:
                $balance->balance -= $event->newQuantity- $event->oldQuantity;
                $product->stock -= $event->newQuantity - $event->oldQuantity;
            break;
            case DetailSaleRepository::DELETED:
                $balance->balance += $event->newQuantity;
                $product->stock += $event->newQuantity;
            break;
        }
        $balance->save();
        $product->save();
    }
}
