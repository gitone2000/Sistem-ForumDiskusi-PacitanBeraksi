<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // card total mahasiswa
        $totalMahasiswa = $this->getTotalMahasiswa();
        //grafik chart
        $dataChart1 = $this->getChart1();
        [$dalamKota, $luarKota] = $this->getChart3();
        $dataChart4 = $this->getChart4();
        $dataChart5 = $this->getChart5();

        return view('admin.dashboard.index', [
            'title' => 'Dashboard Admin',
            //card
            'totalMahasiswa' => $totalMahasiswa,
            //grafik chart
            'dataChart1' => $dataChart1,
            'dataChart3' => ['dalamKota' => $dalamKota, 'luarKota' => $luarKota],
            'dataChart4' => $dataChart4,
            'dataChart5' => $dataChart5
        ]);
    }
    /**
     * Hitung total mahasiswa berdasarkan role.
     *
     * @return int
     */
    private function getTotalMahasiswa(): int
    {
        return User::where('role', 'mahasiswa')->count();
    }

    private function getChart1(): array
    {
        $currentYear = Carbon::now()->year;

        // ambil semua mahasiswa
        $mahasiswa = User::with('perguruan')
            ->where('role', 'mahasiswa')
            ->where('tahun_masuk', $currentYear)
            ->whereNotNull('perguruan_id')
            ->get();
    
        // hitung jumlah mahasiswa per perguruan
        $grouped = $mahasiswa
            ->groupBy(function ($user) {
                return optional($user->perguruan)->nama ?? 'Lainnya';
                })
            ->map(function ($group) {
                return $group->count();
                })
            ->sortDesc();
    
        // ambil 7 perguruan dengan mahasiswa terbanyak
        $top10 = $grouped->take(10);
        $othersTotal = $grouped->skip(10)->sum();
    
        $categories = $top10->keys()->toArray();
        $data = $top10->values()->toArray();
    
        if ($othersTotal > 0) {
            $categories[] = 'Universitas Lainnya';
            $data[] = $othersTotal;
        }
    
        return [
            'categories' => $categories,
            'data' => $data,
            'year' => $currentYear,
        ];
    }
    /**
     * Hitung jumlah mahasiswa dalam kota dan luar kota.
     *
     * Kota Perguruan ID 4 = Dalam Kota (Pacitan)
     *
     * @return array [dalamKota, luarKota]
     */
    private function getChart3(): array
    {
        $mahasiswa = User::with('kotaPerguruan')
            ->where('role', 'mahasiswa')
            ->get();

        $dalamKota = $mahasiswa->filter(function ($user) {
            return $user->kota_perguruan_id == 4;
        })->count();

        $luarKota = $mahasiswa->count() - $dalamKota;

        return [$dalamKota, $luarKota];
    }

    private function getChart4(): array
    {
        $topBidangs = User::select('bidang_id')
        ->where('role', 'mahasiswa')
        ->selectRaw('count(*) as jumlah')
        ->groupBy('bidang_id')
        ->orderByDesc('jumlah')
        ->take(10)
        ->with('bidang') // eager load nama bidang
        ->get();

    $result = [
        'categories' => [],
        'dalam' => [],
        'luar' => [],
        'total' => [],
    ];

    foreach ($topBidangs as $item) {
        $bidang = $item->bidang;

        if (!$bidang) continue; // skip kalau bidang null

        $result['categories'][] = $bidang->nama;

        $dalam = User::where('role', 'mahasiswa')
            ->where('bidang_id', $bidang->id)
            ->where('kota_perguruan_id', 4) // Dalam kota
            ->count();

        $luar = User::where('role', 'mahasiswa')
            ->where('bidang_id', $bidang->id)
            ->where('kota_perguruan_id', '!=', 4) // Luar kota
            ->count();

        $result['dalam'][] = $dalam;
        $result['luar'][] = $luar;
        $result['total'][] = $dalam + $luar;
    }

    return $result;
    }

    private function getChart5(): array
    {
        // $tahunList = range(2020, 2024);
        $currentYear = Carbon::now()->year;
        $startYear = $currentYear - 4;

        $tahunList = range($startYear, $currentYear);

        $result = [
            'categories' => [],
            'dalam' => [],
            'luar' => [],
            'total' => []
        ];

        foreach ($tahunList as $tahun) {
            $mahasiswa = User::where('role', 'mahasiswa')
                ->where('tahun_masuk', $tahun)
                ->get();

            $dalam = $mahasiswa->where('kota_perguruan_id', 4)->count();
            $luar = $mahasiswa->count() - $dalam;
            $total = $mahasiswa->count();

            $result['categories'][] = $tahun;
            $result['dalam'][] = $dalam;
            $result['luar'][] = $luar;
            $result['total'][] = $total;
        }

        return $result;
    }
}
