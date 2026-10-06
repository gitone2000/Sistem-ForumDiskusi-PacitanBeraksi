<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use App\Models\Kecamatan;
use Illuminate\Http\Request;

class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.master.desa.index', [
            'title' => 'Master Desa',
            'desas' => Desa::with('kecamatan')->latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.master.desa.create', [
            'title' => 'Tambah Desa',
            'kecamatans' => Kecamatan::all()
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
        $validatedData = $request->validate([
            'nama' => 'required',
            'kecamatan_id' => 'required|exists:kecamatans,id'
        ]);
    
        Desa::create($validatedData);
        return redirect(route('desa.index'))->with('toast_success', 'Berhasil Menyimpan Desa!');
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
     * @param  \App\Models\Desa $desa
     * @return \Illuminate\Http\Response
     */
    public function edit(Desa $desa)
    {
        return view('admin.master.desa.edit', [
            'title' => 'Edit Desa',
            'desa' => $desa,
            'kecamatans' => Kecamatan::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Desa $desa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Desa $desa)
    {
        $validatedData = $request->validate([
            'nama' => 'required',
            'kecamatan_id' => 'required|exists:kecamatans,id'
        ]);
    
        $desa->update($validatedData);
    
        return redirect(route('desa.index'))->with('toast_success', 'Berhasil Mengupdate Desa!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Desa $desa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Desa $desa)
    {
        Desa::destroy($desa->id);
        return redirect(route('desa.index'))->with('toast_success', 'Berhasil Menghapus Data!');
    }
}
