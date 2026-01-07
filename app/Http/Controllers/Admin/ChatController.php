<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Chat;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        $chats = Chat::with('user')->latest()->paginate(10);
        return view('admin.chats.index', compact('chats'));
    }

    public function show(Chat $chat)
    {
        $chat->load('messages.user');
        return view('admin.chats.show', compact('chat'));
    }

    public function update(Request $request, Chat $chat)
    {
        $chat->status = $request->status; // open, closed
        $chat->save();
        return back();
    }
}
