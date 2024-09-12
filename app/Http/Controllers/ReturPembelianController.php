<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\ReturPembelian;
use App\Models\Retur;

class ReturPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $returs = Retur::where('kondisi_barang','Rusak')->whereNotNull('created_at')->get();
        return view('databarang_rusak',compact('returs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'no_retur_pembelian' => 'required',
            'retur' => 'required',
            'tindakan' => "required",
            'alasan_retur' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $insert = ReturPembelian::create([
            'no_retur_pembelian' => $request->no_retur_pembelian,
            'retur_id' => $request->retur,
            'alasan_retur' => $request->alasan_retur,
            'tindakan' => $request->tindakan
        ]);

        if($insert)
        {
            return redirect()->back()->with('success','Berhasil Buat Data Retur Pemblian');
        } else {
            
            return redirect()->back()->with('error','Gagal Buat Data Retur Pemblian');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
