<?php
namespace App\Http\Controllers;

use App\Events\ChatMessageSent;
use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChannelController extends Controller
{
    // ========================
    // Tampilkan daftar channel
    // ========================
    public function index()
    {
        $channels = Channel::all();
        return view('forum.index', compact('channels'));
    }

    // =====================================
    // Tampilkan detail channel (chat group)
    // =====================================
    public function show($id)
    {
        // $channel = Channel::with('messages.user')->findOrFail($id);
        // return view('forum.chat', compact('channel'));

        $channel = Channel::findOrFail($id);
        // Ambil 30 pesan terakhir, lalu urutkan ulang dari lama ke baru
        $messages = $channel->messages()
            ->with('user')
            ->latest()
            ->take(50)
            ->get()
            ->reverse()
            ->values();

        return view('forum.chat', compact('channel', 'messages'));
    }

    // ===========================
    // Lazy Load Messages (AJAX)
    // ===========================
    public function loadMessages(Request $request, $id)
    {

        $channel = Channel::findOrFail($id);

        $limit  = $request->get('limit', 50); // jumlah pesan per load
        $before = $request->get('before');    // ID pesan terakhir yang dimuat sebelumnya

        $query = $channel->messages()->with('user')->latest();

        if ($before) {
            $query->where('id', '<', $before); // hanya ambil yang lebih lama
        }

        // $messages = $query->take($limit)->get()->reverse()->values(); // urutkan dari lama ke baru
        $messages = $query->orderBy('created_at')->take($limit)->get()->values();

        return response()->json([
            'messages' => $messages->map(function ($msg) {
                return [
                    'id'         => $msg->id,
                    'message'    => $msg->message,
                    'created_at' => $msg->created_at->format('H:i - d M Y'),
                    'user'       => [
                        'id'            => $msg->user->id,
                        'nama'          => $msg->user->nama,
                        'foto_diri_url' => $msg->user->foto_diri_url,
                    ],
                    'file_path'  => $msg->file_path,
                    'file_type'  => $msg->file_type,
                    'file_name'  => $msg->file_path ? basename($msg->file_path) : null,
                ];
            }),
        ]);
    }

    // ====================
    // Send/Submit Message
    // ====================
    public function send(Request $request, $id)
    {
        // dd('Masuk ke method send()', $request->all());
        if (! $request->filled('message') && ! $request->hasFile('file')) {
            return response()->json(['error' => 'Pesan atau file wajib diisi.'], 422);
        }

        $request->validate([
            'message' => 'nullable|string|max:1000',
            'file'    => 'nullable|file|max:10048',
        ]);

        $channel = Channel::findOrFail($id);

        $data = [
            'user_id' => auth()->id(),
            'message' => $request->message,
        ];

        if ($request->hasFile('file')) {
            $file     = $request->file('file');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path     = $file->storeAs('chat_files', $filename, 'public');

            $data['file_path'] = $path;
            $data['file_type'] = $file->getClientMimeType();
        }
        // dd($data);

        // Create Message
        $message = $channel->messages()->create($data);

        // User relasi agar bisa dipakai langsung
        $message->load('user');

        // BROADCAST
        broadcast(new ChatMessageSent($message))->toOthers();

        // Kembalikan JSON respons agar JavaScript bisa langsung menampilkan pesan
        return response()->json([
            'message'    => $message->message,
            'created_at' => $message->created_at->format('H:i'),
            'user'       => [
                'id'            => $message->user->id,
                'nama'          => $message->user->nama,
                'foto_diri_url' => $message->user->foto_diri_url,
            ],
            'file_url'   => $message->file_path ? asset('storage/' . $message->file_path) : null,
            'file_type'  => $message->file_type,
        ]);

        // return redirect()->route('forum.show', $id)->with('success', 'Pesan dikirim');
    }

    // ====================
    // Preview File
    // ====================
    public function previewFile($filename)
    {
        $path = 'chat_files/' . $filename;

        if (! Storage::disk('public')->exists($path)) {
            abort(404, 'File tidak ditemukan.');
        }

        $mime        = Storage::disk('public')->mimeType($path);
        $fileContent = Storage::disk('public')->get($path);

        return response($fileContent, 200)
            ->header('Content-Type', $mime)
            ->header('Content-Disposition', 'inline; filename="' . $filename . '"');
    }
}
