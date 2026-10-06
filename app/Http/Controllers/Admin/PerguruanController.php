<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Perguruan;
use Illuminate\Http\Request;

class PerguruanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.master.perguruan.index', [
            'title' => 'Master Perguruan Tinggi',
            'perguruans' => Perguruan::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.master.perguruan.create', [
            'title' => 'Tambah Perguruan Tinggi',
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
    
        Perguruan::create($validatedData);
        return redirect(route('perguruan.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
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
     * @param  \App\Models\Perguruan $perguruan
     * @return \Illuminate\Http\Response
     */
    public function edit(Perguruan $perguruan)
    {
        return view('admin.master.perguruan.edit', [
            'title' => 'Edit Perguruan Tinggi',
            'perguruan' => $perguruan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Perguruan $perguruan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Perguruan $perguruan)
    {
        $validatedData = $request->validate([
            'nama' => 'required'
        ]);
    
        Perguruan::where('id', $perguruan->id)->update($validatedData);
        return redirect(route('perguruan.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Perguruan $perguruan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Perguruan $perguruan)
    {
        Perguruan::destroy($perguruan->id);
        return redirect(route('perguruan.index'))->with('toast_success', 'Berhasil Menghapus Data!');
    }
}
