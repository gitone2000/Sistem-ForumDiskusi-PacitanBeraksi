<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use Illuminate\Http\Request;

class BidangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.master.bidang.index', [
            'title' => 'Master Bidang Keilmuan',
            'bidangs' => Bidang::latest()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.master.bidang.create', [
            'title' => 'Tambah Bidang Keilmuan',
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
    
        Bidang::create($validatedData);
        return redirect(route('bidang.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
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
     * @param  \App\Models\Bidang $bidang
     * @return \Illuminate\Http\Response
     */
    public function edit(Bidang $bidang)
    {
        return view('admin.master.bidang.edit', [
            'title' => 'Edit Bidang Keilmuan',
            'bidang' => $bidang
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bidang $bidang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bidang $bidang)
{
    $validatedData = $request->validate([
        'nama' => 'required'
    ]);

    Bidang::where('id', $bidang->id)->update($validatedData);
    return redirect(route('bidang.index'))->with('toast_success', 'Berhasil Menyimpan Data!');
}

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bidang $bidang
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bidang $bidang)
    {
        Bidang::destroy($bidang->id);
        return redirect(route('bidang.index'))->with('toast_success', 'Berhasil Menghapus Data!');
    }
}
