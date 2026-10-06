<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Channel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.master.channel.index', [
            'title'    => 'Manajemen Channel Forum',
            'channels' => Channel::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.master.channel.create', [
            'title' => 'Tambah Channel Forum',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar'    => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['nama']);

        if ($request->hasFile('gambar')) {
            $validated['image'] = $request->file('gambar')->store('channels', 'public');
        }

        Channel::create($validated);

        return redirect()->route('channel.index')->with('toast_success', 'Channel berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Channel $channel
     * @return \Illuminate\Http\Response
     */
    public function edit(Channel $channel)
    {
        return view('admin.master.channel.edit', [
            'title'   => 'Edit Channel Forum',
            'channel' => $channel,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Channel $channel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Channel $channel)
    {
        $validated = $request->validate([
            'nama'      => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'gambar'    => 'nullable|image|max:2048',
        ]);

        $validated['slug'] = Str::slug($validated['nama']);

        // Hapus gambar jika admin centang checkbox
        if ($request->filled('hapus_gambar') && $channel->image) {
            Storage::disk('public')->delete($channel->image);
            $validated['image'] = null;
        }

        // Ganti gambar baru jika diupload
        if ($request->hasFile('gambar')) {
            if ($channel->image) {
                Storage::disk('public')->delete($channel->image);
            }
            $validated['image'] = $request->file('gambar')->store('channels', 'public');
        }

        $channel->update($validated);

        return redirect()->route('channel.index')->with('toast_success', 'Channel berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Channel $channel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel)
    {
        $channel->delete();
        return redirect()->route('channel.index')->with('toast_success', 'Channel berhasil dihapus!');
    }
}
