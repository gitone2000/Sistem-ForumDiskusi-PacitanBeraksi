<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Channel;
use Illuminate\Support\Facades\Auth;

class ForumController extends Controller
{
    public function index()
    {
        // Ambil semua user mahasiswa, kecuali user yang sedang login
        $users = User::where('role', 'mahasiswa')
                    ->where('id', '!=', Auth::id())
                    ->get();

        // Ambil semua channel
        $channels = Channel::all();

        return view('forum.index', compact('users','channels'));
    }

    // public function chat(User $user)
    // {
    //     // $user adalah lawan chat
    //     return view('forum.chat', compact('user'));
    // }
}
