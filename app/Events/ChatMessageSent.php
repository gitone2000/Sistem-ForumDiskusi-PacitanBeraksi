<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ChatMessageSent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message;

    public function __construct($message)
    {
        $this->message = $message->load('user'); // agar user ikut terkirim
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('chat.' . $this->message->channel_id);
    }

    public function broadcastAs()
    {
        return 'ChatMessageSent';
    }

    public function broadcastWith()
    {
        return [
            'id'         => $this->message->id,
            'message'    => $this->message->message,
            'user'       => [
                'id'            => $this->message->user->id,
                'nama'          => $this->message->user->nama,
                'foto_diri_url' => $this->message->user->foto_diri
                ? asset('storage/' . $this->message->user->foto_diri)
                : asset('assets/img/decaa.png'),
            ],
            'file_path'  => $this->message->file_path
            ? asset('storage/' . $this->message->file_path)
            : null,
            'file_type'  => $this->message->file_type,
            'created_at' => $this->message->created_at->format('H:i'),
        ];
    }
}
