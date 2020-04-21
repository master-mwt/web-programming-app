<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewReply extends Notification implements ShouldQueue
{
    use Queueable;

    private $body;
    private $post_id;

    /**
     * Create a new notification instance.
     *
     * @param $body
     * @param $post_id
     */
    public function __construct($body, $post_id)
    {
        $this->body = $body;
        $this->post_id = $post_id;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'data' => $this->body,
            'post_id' => $this->post_id,
        ];
    }
}
