<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Bidang;
use App\Models\Perguruan;
use App\Models\KotaPerguruan;
use App\Models\Kecamatan;
use App\Models\Desa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAdmin()
    {
        $users = User::where('role', 'admin')->latest()->get();
        return view('admin.user.index', [
            'title' => 'Data User Admin',
            'users' => $users,
            'role' => 'admin'
        ]);
    }
    public function indexMahasiswa()
    {
        $users = User::where('role', 'mahasiswa')->latest()->get();
        return view('admin.user.index', [
            'title' => 'Data User Mahasiswa',
            'users' => $users,
            'role' => 'mahasiswa'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd(Auth::user());
        return view('admin.user.create', [
            'title' => 'Tambah User',
            'bidangs' => Bidang::all(),
            'perguruans' => Perguruan::all(),
            'kota_perguruans' => KotaPerguruan::all(),
            'kecamatans' => Kecamatan::all(),
            'desas' => Desa::all(),
        ]);
    }

    public function getDesa($kecamatan_id)
    {
        $desas = Desa::where('kecamatan_id', $kecamatan_id)->pluck('nama', 'id');
        return response()->json($desas);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'nullable|string|max:20',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',

            'bidang_id' => 'nullable|exists:bidangs,id',
            'perguruan_id' => 'nullable|exists:perguruans,id',
            'kota_perguruan_id' => 'nullable|exists:kota_perguruans,id',
            'jenjang' => 'nullable|string',
            'program_studi' => 'nullable|string',
            'whatsapp' => 'nullable|string|max:20',

            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
            'kecamatan_id' => 'nullable|exists:kecamatans,id',
            'desa_id' => 'nullable|exists:desas,id',
            'tahun_masuk' => 'nullable|integer',

            'foto_diri' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
            'ktm' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
            'linkedin' => 'nullable|url',
            'portofolio' => 'nullable|url',
            'ig' => 'nullable|string',
            'role' => 'required|in:admin,mahasiswa',
        ]);

    // Simpan file jika ada
    if ($request->hasFile('foto_diri')) {
        $validated['foto_diri'] = $request->file('foto_diri')->store('foto_diri', 'public');
    }

    if ($request->hasFile('ktm')) {
        $validated['ktm'] = $request->file('ktm')->store('ktm', 'public');
    }

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()->route($validated['role'] === 'admin' ? 'user.admin.index' : 'user.mhs.index')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->load([
        'bidang',
        'perguruan',
        'kotaPerguruan',
        'kecamatan',
        'desa'
    ]);
        return view('admin.user.show', [
            'title' => 'Detail Biodata User',
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $bidangs = Bidang::all();
        $perguruans = Perguruan::all();
        $kota_perguruans = KotaPerguruan::all();
        $kecamatans = Kecamatan::all();
        $desas = Desa::all();

        $title = 'Edit Data User';
        return view('admin.user.edit', compact('user', 'bidangs', 'perguruans', 'kota_perguruans', 'kecamatans', 'desas', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'nullable|string|max:20',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6|confirmed',

            'bidang_id' => 'nullable|exists:bidangs,id',
            'perguruan_id' => 'nullable|exists:perguruans,id',
            'kota_perguruan_id' => 'nullable|exists:kota_perguruans,id',
            'jenjang' => 'nullable|string',
            'program_studi' => 'nullable|string',
            'whatsapp' => 'nullable|string|max:20',

            'tempat_lahir' => 'nullable|string',
            'tanggal_lahir' => 'nullable|date',
            'jenis_kelamin' => 'nullable|in:Laki-laki,Perempuan',
            'alamat' => 'nullable|string',
            'kecamatan_id' => 'nullable|exists:kecamatans,id',
            'desa_id' => 'nullable|exists:desas,id',
            'tahun_masuk' => 'nullable|integer',

            'foto_diri' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
            'ktm' => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
            'linkedin' => 'nullable|url',
            'portofolio' => 'nullable|url',
            'ig' => 'nullable|string',
            'role' => 'required|in:admin,mahasiswa',
        ]);

        // Jika ada file baru
        if ($request->hasFile('foto_diri')) {
            // Hapus file lama jika ada
            if ($user->foto_diri) Storage::disk('public')->delete($user->foto_diri);
            $validated['foto_diri'] = $request->file('foto_diri')->store('foto_diri', 'public');
        }

        if ($request->hasFile('ktm')) {
            if ($user->ktm) Storage::disk('public')->delete($user->ktm);
            $validated['ktm'] = $request->file('ktm')->store('ktm', 'public');
        }

        // Kalau password dikosongkan, jangan update
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return redirect()->route($user->role === 'admin' ? 'user.admin.index' : 'user.mhs.index')->with('success', 'User berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Request  $request)
    {
        // dd($request->all());
        $user->delete();

        $redirectTo = $request->input('redirect_to');

            if ($redirectTo && Str::startsWith($redirectTo, url('/admin'))) {
            return redirect($redirectTo)->with('toast_success', 'Berhasil Menghapus Data!');
        }

        return redirect()->route('user.admin.index')->with('toast_success', 'Berhasil Menghapus Data!');
    }
}
