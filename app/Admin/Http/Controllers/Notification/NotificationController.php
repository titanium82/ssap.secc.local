<?php

namespace App\Admin\Http\Controllers\Notification;

use App\Admin\Http\Controllers\Controller;
use Illuminate\Notifications\DatabaseNotification;

class NotificationController extends Controller
{

    public function __construct(
        public DatabaseNotification $notify
    )
    {
    }
    
    public function show($id)
    {
        $notify = $this->notify->findOrFail($id);
        
        $notify->markAsRead();

        return redirect($notify->data['url']);
    }
}