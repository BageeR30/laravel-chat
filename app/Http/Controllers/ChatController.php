<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        return response()->noContent();
    }
}
