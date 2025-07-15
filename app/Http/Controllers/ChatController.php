<?php
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function index()
    {
        // Example: list of users current user can chat with
        $users = User::where('id', '!=', Auth::id())->get();
        return view('chat.index', compact('users'));
    }

    public function show($targetUserId)
    {
        $targetUser = User::findOrFail($targetUserId);

        // Optional role check
        // abort_if(!$targetUser->hasRole('supplier'), 403);

        return view('chat.chat-window', compact('targetUser'));
    }
}