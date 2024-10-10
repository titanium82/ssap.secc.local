<?php

namespace App\Admin\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Notification;

class Notify extends Notification
{
    use Queueable;

    public string $title;
    
    public string $subTitle;

    public string $url;

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return $this->makeData();
    }

    protected function setTitle(): void
    {
        $this->title = '';
    }
    protected function getTitle(): string
    {
        $this->setTitle();

        return $this->title;
    }

    protected function setSubTitle(): void
    {
        $this->subTitle = '';
    }

    protected function getSubTitle(): string
    {
        $this->setSubTitle();
        
        return $this->subTitle;
    }

    protected function setUrl(): void
    {
        $this->url = '';
    }

    protected function getUrl(): string
    {
        $this->setUrl();
        return $this->url;
    }

    protected function makeData(): array
    {
        return [
            'title' => $this->getTitle(),
            'url' => $this->getUrl(),
            'sub_title' => $this->getSubTitle()
        ];
    }
}