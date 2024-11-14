<?php
 
namespace App\Admin\View\Composers;
 
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
 
class NotifyComposer
{
    /**
     * Create a new profile composer.
     *
     * @param  \App\Repositories\UserRepository  $users
     * @return void
     */
    public function __construct()
    {

    }
 
    /**
     * Bind data to the view.
     *
     * @param  \Illuminate\View\View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $notifications = Auth::guard('admin')->user()->notifications()->select('id', 'type', 'data', 'read_at', 'created_at')->limit(15)->get();
        
        $countNotifyUnread = Auth::guard('admin')->user()->unreadNotifications()->count();
        
        $view->with([
            'notifications' => $notifications,
            'count_notify_unread' => $countNotifyUnread
        ]);
    }
}