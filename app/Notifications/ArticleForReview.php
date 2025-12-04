<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ArticleForReview extends Notification
{
    use Queueable;
    protected $article;

    /**
     * Create a new notification instance.
     */
    public function __construct($article)
    {
        $this->article = $article;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'slug' => $this->article->slug,
            'title' => $this->article->title,
            'author' => $this->article->author->name,
            'message' => 'mengunggah artikel untuk direview',
        ];
    }
}
