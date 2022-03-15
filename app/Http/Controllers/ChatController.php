<?php

namespace App\Http\Controllers;

use App\Mail\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ChatController extends Controller
{
    public function index(User $user)
    {
        return inertia('Main', [
            'users' => User::whereNot('id', Auth::user()->id)->get(),
            'chatlog' => Auth::user()->getChatLogWith($user),
        ]);
    }

    public function sendMessage(Request $request)
    {
        $message = $request->input('message', '');
        $userId = $request->input('to');
        $userTo = User::findOrFail($userId);
        if (strlen($message)) {
            Auth::user()->sendMessageTo($userTo, $message);
        }
        if ($request->input('send_email', false)) { //TODO:check presence by webhook from pusher
            Mail::to($userTo)->queue(new Notification(Auth::user()));
        }
        return response()->noContent();
    }
}
