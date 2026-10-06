<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KotaPerguruan;
use Illuminate\Http\Request;

class KotaPerguruanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.master.kotaperguruan.index', [
            'title' => 'Master Kota Perguruan Tinggi',
            'kotaperguruan' => KotaPerguruan::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.master.kotaperguruan.create', [
            'title' => 'Tambah Kota Perguruan Tinggi',
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
            'nama' => 'required'
        ]);
    
        KotaPerguruan::create($validatedData);
        return redirect(route('kotaperguruan.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
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
     * @param  \App\Models\KotaPerguruan $kotaperguruan
     * @return \Illuminate\Http\Response
     */
    public function edit(KotaPerguruan $kotaperguruan)
    {
        return view('admin.master.kotaperguruan.edit', [
            'title' => 'Edit Kota Perguruan',
            'kotaperguruan' => $kotaperguruan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\KotaPerguruan $kotaperguruan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, KotaPerguruan $kotaperguruan)
    {
        $validatedData = $request->validate([
            'nama' => 'required'
        ]);
    
        KotaPerguruan::where('id', $kotaperguruan->id)->update($validatedData);
        return redirect(route('kotaperguruan.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\KotaPerguruan $kotaperguruan
     * @return \Illuminate\Http\Response
     */
    public function destroy(KotaPerguruan $kotaperguruan)
    {
        KotaPerguruan::destroy($kotaperguruan->id);
        return redirect(route('kotaperguruan.index'))->with('toast_success', 'Berhasil Menghapus Data!');
    }
}
