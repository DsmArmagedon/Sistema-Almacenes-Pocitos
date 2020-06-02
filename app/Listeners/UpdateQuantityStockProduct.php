<?php

namespace App\Listeners;

use App\Events\InputOutputCreatedUpdatedDeleted;
use App\Models\Balance;
use App\Models\InputOutput;
use App\Models\Product;
use App\Repositories\InputOutputRepository;

class UpdateQuantityStockProduct
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
     * @param  InputOutputCreatedUpdatedDeleted  $event
     * @return void
     */
    public function handle(InputOutputCreatedUpdatedDeleted $event)
    {
        $io = $event->inputOutput;
        $product = Product::findOrFail($io->product_code);
        $balance = Balance::getObjectBalance($product->code);
        switch($event->typeMethod) {
            case InputOutputRepository::CREATED:
                if($io->type === InputOutput::INPUT) {
                    $product->stock += $io->quantity;
                    $balance->balance += $io->quantity;
                } else {
                    $product->stock -=  $io->quantity;
                    $balance->balance -=  $io->quantity;
                }
            break;
            case InputOutputRepository::UPDATED:
                $quantity = $io->quantity - $io->getOriginal()['quantity'];
                if($io->type === InputOutput::INPUT) {
                    $product->stock += $quantity;
                    $balance->balance += $quantity;
                } else {
                    $product->stock -=  $quantity;
                    $balance->balance -=  $quantity;
                }
            break;
            case InputOutputRepository::DELETED:
                if($io->type === InputOutput::INPUT) {
                    $product->stock -= $io->quantity;
                    $balance->balance -= $io->quantity;
                } else {
                    $product->stock +=  $io->quantity;
                    $balance->balance +=  $io->quantity;
                }
            break;
        }
        $product->save();
        $balance->save();
        return $product;
    }
}
