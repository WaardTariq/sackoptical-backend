<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class SupportMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(15);
        return view('admin.support.index', compact('messages'));
    }

    public function show(ContactMessage $support_message)
    {
        $support_message->update(['is_read' => true]);
        return view('admin.support.show', [
            'message' => $support_message
        ]);
    }

    public function destroy(ContactMessage $support_message)
    {
        $support_message->delete();
        return back()->with('success', 'Message deleted successfully.');
    }

    public function getUnreadCount()
    {
        $count = ContactMessage::where('is_read', false)->count();
        $latest = ContactMessage::where('is_read', false)->latest()->first();

        return response()->json([
            'count' => $count,
            'latest' => $latest
        ]);
    }
}
