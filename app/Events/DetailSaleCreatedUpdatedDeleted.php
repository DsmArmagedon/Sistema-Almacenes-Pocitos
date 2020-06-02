<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class DetailSaleCreatedUpdatedDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $productCode;
    public $newQuantity;
    public $oldQuantity;
    public $typeMethod;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($productCode, $typeMethod, $newQuantity, $oldQuantity = 0)
    {
        $this->productCode = $productCode;
        $this->typeMethod = $typeMethod;
        $this->newQuantity = $newQuantity;
        $this->oldQuantity = $oldQuantity;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
