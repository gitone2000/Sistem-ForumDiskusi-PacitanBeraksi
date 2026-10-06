<?php
namespace App\Http\Controllers;

use App\Models\Bidang;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\KotaPerguruan;
use App\Models\Perguruan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // ========================
    // AUTHENTIKASI
    // ========================

    public function index()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }
        return view('auth.login');
    }

    public function create()
    {
        if (Auth::check()) {
            return redirect('/dashboard');
        }

        $bidangs         = Bidang::all();
        $perguruans      = Perguruan::all();
        $kota_perguruans = KotaPerguruan::all();

        return view('auth.register', compact('bidangs', 'perguruans', 'kota_perguruans'));
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required'    => 'Email wajib diisi.',
            'email.email'       => 'Format email tidak valid.',
            'password.required' => 'Password wajib diisi.',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Cek apakah data diri sudah lengkap
            if (! $this->isDataDiriLengkap($user)) {
                return redirect()->route('lengkapi.data');
            }

            // Arahkan berdasarkan role
            if ($user->role == 'admin') {
                // Jika role admin, arahkan ke dashboard admin
                return redirect()->route('admin.dashboard');
            } elseif ($user->role == 'mahasiswa') {
                // Jika role mahasiswa, arahkan ke dashboard mahasiswa
                return redirect()->route('user.mhs.index');
            }

            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil logout.');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'nama'              => 'required',
            'nim'               => 'required',
            'email'             => 'required|email|unique:users,email',
            'bidang_id'         => 'required',
            'perguruan_id'      => 'required',
            'kota_perguruan_id' => 'required',
            'jenjang'           => 'required',
            'program_studi'     => 'required',
            'whatsapp'          => 'required',
            'password'          => 'required|min:6|confirmed',
        ], [
            'nama.required'              => 'Nama wajib diisi.',
            'nim.required'               => 'NIM wajib diisi.',
            'email.required'             => 'Email wajib diisi.',
            'email.email'                => 'Format email tidak valid.',
            'email.unique'               => 'Email sudah terdaftar.',
            'bidang_id.required'         => 'Bidang keilmuan wajib diisi.',
            'perguruan_id.required'      => 'Perguruan tinggi wajib diisi.',
            'kota_perguruan_id.required' => 'Perguruan tinggi wajib diisi.',
            'jenjang.required'           => 'Jenjang tinggi wajib diisi.',
            'program_studi.required'     => 'Program studi wajib diisi.',
            'whatsapp.required'          => 'Nomor WhatsApp wajib diisi.',
            'password.required'          => 'Password wajib diisi.',
            'password.min'               => 'Password minimal 6 karakter.',
            'password.confirmed'         => 'Konfirmasi password tidak cocok.',
        ]);

        $bidang = is_numeric($request->bidang_id)
        ? Bidang::findOrFail($request->bidang_id)
        : Bidang::firstOrCreate(['nama' => $request->bidang_id]);

        $perguruan = is_numeric($request->perguruan_id)
        ? Perguruan::findOrFail($request->perguruan_id)
        : Perguruan::firstOrCreate(['nama' => $request->perguruan_id]);

        $kota = is_numeric($request->kota_perguruan_id)
        ? KotaPerguruan::findOrFail($request->kota_perguruan_id)
        : KotaPerguruan::firstOrCreate(['nama' => $request->kota_perguruan_id]);

        User::create([
            'nama'              => $request->nama,
            'nim'               => $request->nim,
            'email'             => $request->email,
            'bidang_id'         => $bidang->id,
            'perguruan_id'      => $perguruan->id,
            'kota_perguruan_id' => $kota->id,
            'jenjang'           => $request->jenjang,
            'program_studi'     => $request->program_studi,
            'whatsapp'          => $request->whatsapp,
            'password'          => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    // ========================
    // LENGKAPI DATA DIRI
    // ========================

    public function lengkapiData()
    {
        $user = Auth::user();

        if ($this->isDataDiriLengkap($user)) {
            return redirect('/dashboard');
        }
        $bidangs         = Bidang::all();
        $perguruans      = Perguruan::all();
        $kota_perguruans = KotaPerguruan::all();
        $kecamatans      = Kecamatan::all();

        return view('auth.lengkapi-data', compact('user', 'bidangs', 'perguruans', 'kota_perguruans', 'kecamatans'));
    }

    public function simpanData(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'tempat_lahir'  => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'alamat'        => 'required|string',
            'kecamatan_id'  => 'required|exists:kecamatans,id',
            'desa_id'       => 'required|exists:desas,id',
            'tahun_masuk'   => 'required|string|max:10',
            'foto_diri'     => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
            'ktm'           => 'nullable|image|mimes:jpeg,png,jpg|max:5048',
            'linkedin'      => 'nullable|url',
            'portofolio'    => 'nullable|url',
            'ig'            => 'nullable|string|max:255',
        ]);

        $user = Auth::user();

        // Upload file jika ada
        if ($request->hasFile('foto_diri')) {
            $user->foto_diri = $request->file('foto_diri')->store('foto_diri', 'public');
        }

        if ($request->hasFile('ktm')) {
            $user->ktm = $request->file('ktm')->store('ktm', 'public');
        }

        $bidang = is_numeric($request->bidang_id)
        ? Bidang::findOrFail($request->bidang_id)
        : Bidang::firstOrCreate(['nama' => $request->bidang_id]);

        $perguruan = is_numeric($request->perguruan_id)
        ? Perguruan::findOrFail($request->perguruan_id)
        : Perguruan::firstOrCreate(['nama' => $request->perguruan_id]);

        $kota = is_numeric($request->kota_perguruan_id)
        ? KotaPerguruan::findOrFail($request->kota_perguruan_id)
        : KotaPerguruan::firstOrCreate(['nama' => $request->kota_perguruan_id]);

        // Update data lainnya
        $user->update([
            'nama'              => $request->nama,
            'nim'               => $request->nim,
            'email'             => $request->email,
            'tempat_lahir'      => $request->tempat_lahir,
            'tanggal_lahir'     => $request->tanggal_lahir,
            'whatsapp'          => $request->whatsapp,
            'jenis_kelamin'     => $request->jenis_kelamin,
            'alamat'            => $request->alamat,
            'kecamatan_id'      => $request->kecamatan_id,
            'desa_id'           => $request->desa_id,
            'bidang_id'         => $bidang->id,
            'perguruan_id'      => $perguruan->id,
            'kota_perguruan_id' => $kota->id,
            'jenjang'           => $request->jenjang,
            'program_studi'     => $request->program_studi,
            'tahun_masuk'       => $request->tahun_masuk,
            'linkedin'          => $request->linkedin,
            'portofolio'        => $request->portofolio,
            'ig'                => $request->ig,
            'foto_diri'         => $user->foto_diri,
            'ktm'               => $user->ktm,
        ]);

        return redirect('/dashboard')->with('success', 'Data diri berhasil dilengkapi.');
    }

    private function isDataDiriLengkap($user)
    {
        return $user->nama &&
        $user->nim &&
        $user->email &&
        $user->whatsapp &&
        $user->tempat_lahir &&
        $user->tanggal_lahir &&
        $user->jenis_kelamin &&
        $user->alamat &&
        $user->kecamatan_id &&
        $user->desa_id &&
        $user->bidang_id &&
        $user->perguruan_id &&
        $user->kota_perguruan_id &&
        $user->jenjang &&
        $user->program_studi &&
        $user->tahun_masuk;
    }

    public function getDesa($kecamatan_id)
    {
        $desas = Desa::where('kecamatan_id', $kecamatan_id)->pluck('nama', 'id');
        return response()->json($desas);
    }

    // ========================
    // EDIT DATA DIRI
    // ========================

    public function editDataDiri()
    {
        $user            = Auth::user();
        $bidangs         = Bidang::all();
        $perguruans      = Perguruan::all();
        $kota_perguruans = KotaPerguruan::all();
        $kecamatans      = Kecamatan::all();

        return view('auth.lengkapi-data', compact('user', 'bidangs', 'perguruans', 'kota_perguruans', 'kecamatans'));
    }

    // ========================
    // RESOURCE METHOD (Optional)
    // ========================

    public function show($id)
    { /* optional */}

    public function edit($id)
    { /* optional */}

    public function update(Request $request, $id)
    { /* optional */}

    public function destroy($id)
    { /* optional */}
}
