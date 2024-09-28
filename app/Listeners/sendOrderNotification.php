<?php

namespace App\Listeners;

use App\Events\OrderCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class sendOrderNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     */

     use InteractsWithQueue;

    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(OrderCreated $event): void
    {
        \Log::info('Listener berjalan, mengirim notifikasi FCM...');
        \Log::info('Order ID: ' . $event->pesanan->id);

        $fcmToken = $event->token;
        $messaging = app('firebase.messaging');
        $message = CloudMessage::withTarget('token', $fcmToken)
        ->withNotification(Notification::create('Notification', 'Ada pesanan'));
        $messaging->send($message);
    }
}
