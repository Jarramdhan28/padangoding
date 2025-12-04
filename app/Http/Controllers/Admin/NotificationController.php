<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function getNotofications()
    {
        $notifications = Auth::user()->notifications()->get();
        $unreadNotifications = Auth::user()->unreadNotifications()->count();

        $data = [
            'notifications' => $notifications,
            'unread_count' => $unreadNotifications,
        ];

        return ResponseHelper::fetchResponse((bool) $data, $data);
    }

    public function markAsRead($notificationId)
    {
        $notification = Auth::user()->notifications()->where('id', $notificationId)->first();
        if (!$notification) {
            return ResponseHelper::errorResponse('Notification not found.', 404);
        }
        $slug = $notification->data['slug'] ?? null;

        $notification->markAsRead();
        return ResponseHelper::sendResponse(true, 'baca', 'Notification telah', route('admin.article.detail', $slug));
    }

    public function destroy($notificationId)
    {
        $notification = Auth::user()->notifications()->where('id', $notificationId)->first();
        if (!$notification) {
            return ResponseHelper::errorResponse('Notification not found.', 404);
        }

        $notification->delete();
        return ResponseHelper::sendResponse(true, 'hapus', 'Notification telah dihapus.');
    }

}
