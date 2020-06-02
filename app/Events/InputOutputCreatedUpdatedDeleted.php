<?php

namespace App\Events;

use App\Models\InputOutput;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class InputOutputCreatedUpdatedDeleted
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $inputOutput;
    public $typeMethod;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(InputOutput $inputOutput, $typeMethod)
    {
        $this->inputOutput = $inputOutput;
        $this->typeMethod = $typeMethod;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
