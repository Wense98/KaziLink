<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        // Get all unique users this user has messaged or received messages from
        $contacts = User::whereIn('id', function($query) use ($user) {
            $query->select('receiver_id')
                ->from('messages')
                ->where('sender_id', $user->id)
                ->union(
                    Message::select('sender_id')
                        ->where('receiver_id', $user->id)
                );
        })->get();

        return view('messages.index', compact('contacts'));
    }

    public function show(User $user)
    {
        $activeContact = $user;
        $currentUser = Auth::user();
        
        $messages = Message::where(function($q) use ($currentUser, $activeContact) {
            $q->where('sender_id', $currentUser->id)
              ->where('receiver_id', $activeContact->id);
        })->orWhere(function($q) use ($currentUser, $activeContact) {
            $q->where('sender_id', $activeContact->id)
              ->where('receiver_id', $currentUser->id);
        })->orderBy('created_at', 'asc')->get();

        // Mark as read
        Message::where('sender_id', $activeContact->id)
               ->where('receiver_id', $currentUser->id)
               ->whereNull('read_at')
               ->update(['read_at' => now()]);

        // Get all contacts again for the sidebar
        $contacts = User::whereIn('id', function($query) use ($currentUser) {
            $query->select('receiver_id')
                ->from('messages')
                ->where('sender_id', $currentUser->id)
                ->union(
                    Message::select('sender_id')
                        ->where('receiver_id', $currentUser->id)
                );
        })->get();

        return view('messages.index', compact('contacts', 'activeContact', 'messages'));
    }

    public function store(Request $request, User $user)
    {
        $request->validate([
            'body' => 'nullable|string|max:1000',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,mp3,wav,ogg|max:10240' // 10MB max
        ]);

        if (!$request->body && !$request->hasFile('attachment')) {
            return back()->withErrors(['body' => 'Message cannot be empty.']);
        }

        $path = null;
        $type = 'text';

        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $path = $file->store('attachments', 'public');
            
            // Simple type detection
            $mime = $file->getMimeType();
            if (str_contains($mime, 'image')) {
                $type = 'image';
            } elseif (str_contains($mime, 'audio')) {
                $type = 'audio';
            }
        }

        Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $user->id,
            'body' => $request->body,
            'attachment_type' => $type,
            'attachment_path' => $path
        ]);

        return back()->with('status', 'message-sent');
    }
}
