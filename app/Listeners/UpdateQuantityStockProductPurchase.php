<?php

namespace App\Listeners;

use App\Events\DetailPurchaseCreatedUpdatedDeleted;
use App\Models\Balance;
use App\Models\Product;
use App\Repositories\DetailPurchaseRepository;

class UpdateQuantityStockProductPurchase
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
     * @param  DetailPurchaseCreatedUpdatedDeleted  $event
     * @return void
     */
    public function handle(DetailPurchaseCreatedUpdatedDeleted $event)
    {
        $product = Product::findOrFail($event->productCode);
        $balance = Balance::getObjectBalance($product->code);
        switch($event->typeMethod) {
            case DetailPurchaseRepository::CREATED:
                $balance->balance += $event->newQuantity;
                $product->stock += $event->newQuantity;
            break;
            case DetailPurchaseRepository::UPDATED:
                $balance->balance += $event->newQuantity- $event->oldQuantity;
                $product->stock += $event->newQuantity - $event->oldQuantity;
            break;
            case DetailPurchaseRepository::DELETED:
                $balance->balance -= $event->newQuantity;
                $product->stock -= $event->newQuantity;
            break;
        }
        $balance->save();
        $product->save();
    }
}
