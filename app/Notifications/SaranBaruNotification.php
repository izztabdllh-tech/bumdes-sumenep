<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class SaranBaruNotification extends Notification
{
    use Queueable;

    protected $saran;

    public function __construct($saran)
    {
        $this->saran = $saran;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'title' => 'Saran Baru',
            'message' => 'Ada saran baru dari ' . $this->saran->nama . ' (' . $this->saran->kategori . ')',
            'url' => route('admin.saran.index'),
            'saran_id' => $this->saran->id,
        ];
    }
}