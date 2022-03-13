<?php

namespace App\Events;

use App\Models\Message;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class MessageSend implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public $user_from, $user_to, $message;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(User $user_from, User $user_to, string $message)
    {
        $this->user_from = $user_from;
        $this->user_to = $user_to;
        $this->message = $message;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        Message::create([
            'from_user' => $this->user_from->id,
            'to_user' => $this->user_to->id,
            'text' => $this->message,
        ]);
        return new PrivateChannel('chat.' . $this->user_to->id);
    }
}
