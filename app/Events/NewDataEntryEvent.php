<?php

namespace App\Events;

use App\Models\Data;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewDataEntryEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public ?Data $data = null;

    public function __construct(Data $data)
    {
        $this->data = $data;
    }

    public function broadcastOn(): Channel
    {
        return new PrivateChannel('data-entry-of-' . $this->data->variable->id);
    }

    public function broadcastAs(): string
    {
        return 'new-entry';
    }
}
