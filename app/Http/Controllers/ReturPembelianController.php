<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Session;
use App\Models\ReturPembelian;
use App\Models\Retur;
use App\Exports\LaporanReturPembelian;
use Maatwebsite\Excel\Facades\Excel;

class ReturPembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $returs = Retur::where('kondisi_barang','Rusak(Sudah Diproses)')->orWhere('kondisi_barang','Rusak')->whereNotNull('created_at')->orderBy('created_at','DESC')->get();
        return view('databarang_rusak',compact('returs'));
    }

    public function returShow()
    {
        $ret = Retur::where('kondisi_barang','Rusak')->whereNotNull('created_at')->orderBy('created_at','DESC')->get();
        $returs = ReturPembelian::with('retur.produk')->orderBy('created_at','DESC')->get();
        return view('datareturpembelian',compact('returs','ret'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'nota_retur_pembelian' => 'required',
            'retur' => 'required',
            'tindakan' => "required",
            'alasan_retur' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $insert = ReturPembelian::create([
            'nota_retur_pembelian' => $request->nota_retur_pembelian,
            'retur_id' => Crypt::decrypt($request->retur),
            'alasan_retur' => $request->alasan_retur,
            'tindakan' => $request->tindakan
        ]);

        if($insert)
        {
            $data = ReturPembelian::with('retur.produk')->where('id',$insert->id)->first();
            $dataArray = [
                'nota' => $data->nota_retur_pembelian,
                'kode_barang' => $data->retur->produk->kode_barang ?? 'N/A',
                'nama_produk' => $data->retur->produk->nama_produk ?? 'N/A',
                'jenis_barang' => $data->retur->produk->jenis_barang ?? 'N/A',
                'jumlah_barang' => $data->retur->jumlah_barang ?? 'N/A',
                'kondisi' => $data->retur->kondisi_barang ?? 'N/A',
                'tgl_datang' => $data->retur->tgl_masuk_gudang ?? 'N/A',
                'alasan' => $data->alasan_retur,
                'tindakan' => $data->tindakan
            ];

            Session::put('data_excel',$dataArray);
            Session::flash('laporanreturpembelian','Berhasil');
            return redirect()->back()->with('success','Berhasil Buat Data Retur Pemblian Silahkan Cek Di Bagian Data Barang Di Retur dan Laporan Akan Dicetak dalam 3 Detik');
        } else {
            return redirect()->back()->with('error','Gagal Buat Data Retur Pemblian');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'nota_retur_pembelian_edit' => 'required',
            'retur_edit' => 'required',
            'tindakan_edit' => "required",
            'alasan_retur_edit' => 'required',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $update = ReturPembelian::where('id',$id)->update([
            'nota_retur_pembelian' => $request->nota_retur_pembelian_edit,
            'retur_id' => Crypt::decrypt($request->retur_edit),
            'alasan_retur' => $request->alasan_retur_edit,
            'tindakan' => $request->tindakan_edit
        ]);
        if($update)
        {
            return redirect()->back()->with('success','Berhasil Update Data');
        } else {
            return redirect()->back()->with('error','Gagal Update Data');
        }
    }

    public function cetakLaporanRetur()
    {
        $dataArray = Session::get('data_excel');
        
        Session::forget('data_excel');

        return Excel::download(new LaporanReturPembelian($dataArray), 'Laporan Retur Pembelian -'.$dataArray['nota'].'-'.$dataArray['kode_barang'].'-'.$dataArray['tgl_datang'].'.xlsx');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        ReturPembelian::where('id',$id)->delete();
        return redirect()->back()->with('success','Berhasil Hapus Data Retur Pembelian');
    }
}
