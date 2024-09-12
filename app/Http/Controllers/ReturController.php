<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Retur;
use App\Models\Stock;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Barryvdh\DomPDF\Facade\Pdf;
use Barryvdh\DomPDF\ServiceProvider;
use App\Exports\ReturExportBaik;
use App\Services\LaporanStokService;
use Illuminate\Support\Facades\Crypt;

class ReturController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $laporanstok;
    public function __construct(LaporanStokService $laporanstok)
    {
        $this->laporanstok = $laporanstok;
    }

    public function index()
    {
        $returs = Retur::with('produk')->get();
        return view('dataretur',compact('returs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_barang' => 'required',
            'nama_produk' => 'required',
            'jenis_barang' => 'required',
            'harga_produk' => 'required',
            'supplier' => 'required',
            'no_hp_supplier' => 'required|numeric',
            'alamat_supplier' => 'required',
            'tgl_masuk_gudang' => 'required',
            'jumlah_barang' => 'required|numeric',
            'kondisi_barang' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $produk = Produk::create([
            'kode_barang' => $request->kode_barang,
            'nama_produk' => $request->nama_produk,
            'jenis_barang' => $request->jenis_barang,
            'harga_produk' => $request->harga_produk
        ]);
        if(!$produk){
            return redirect()->back()->with('error','Terjadi Kesalahan Saat Input Data Mohon Periksa Kembali');
        }

        $stok = Stock::where('produk_id',$produk->id)->latest()->first();

        if($request->kondisi_barang === "Baik")
        {
            if(is_null($stok))
            {
                $stok = $request->jumlah_barang;
                $stok_masuk = $stok;
                $stok_keluar = 0;
            } else {
                $stok = $stok->stok + $request->jumlah_barang;
                $stok_masuk = $request->jumlah_barang;
                $stok_keluar = 0;
            } 

            $insert = Stock::create([
                'produk_id' => $produk->id,
                'stok' => $stok,
                'stok_masuk' => $stok_masuk,
                'stok_keluar' => $stok_keluar,
                'tanggal' => Carbon::now()->format("Y-m-d")
            ]);

            if(!$insert){
                return redirect()->back()->with('error','Terjadi Kesalahan Saat Input Data Mohon Periksa Kembali');
            }
            

        }

        $insert = Retur::create([
            'produks_id' => $produk->id,
            'supplier' => $request->supplier,
            'no_hp_supplier' => $request->no_hp_supplier,
            'alamat_supplier' => $request->alamat_supplier,
            'tgl_masuk_gudang' => $request->tgl_masuk_gudang,
            'jumlah_barang' => $request->jumlah_barang,
            'kondisi_barang' => $request->kondisi_barang,
        ]);

        if(!$insert){
            return redirect()->back()->with('error','Terjadi Kesalahan Saat Input Data Mohon Periksa Kembali');
        }

        if($request->kondisi_barang === "Baik")
        {
            Session::flash('kondisibaik','Laporan Stok akan Siap dalam 3 detik');
        }

        return redirect()->back()->with('success','Berhasil Entri Data');

        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_barang_edit' => 'required',
            'nama_produk_edit' => 'required',
            'jenis_barang_edit' => 'required',
            'harga_produk_edit' => 'required',
            'supplier_edit' => 'required',
            'no_hp_supplier_edit' => 'required|numeric',
            'alamat_supplier_edit' => 'required',
            'tgl_masuk_gudang_edit' => 'required',
            'jumlah_barang_edit' => 'required|numeric',
            'kondisi_barang_edit' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        // Temukan retur berdasarkan retur_id dari request
        $retur = Retur::find(Crypt::decrypt($request->jkUgdw720P62))->first();
        // $produk = Produk::find($id);
        
        if(!$retur){
            return redirect()->back()->with('error','Produk tidak ditemukan');
        }
        
        // Update data produk
        Produk::where('id',$retur->produks_id)->update([
            'kode_barang' => $request->kode_barang_edit,
            'nama_produk' => $request->nama_produk_edit,
            'jenis_barang' => $request->jenis_barang_edit,
            'harga_produk' => $request->harga_produk_edit,
        ]);
        
        $stok = Stock::where('produk_id', $retur->produks_id)->latest()->first();

        // Tentukan stok, stok masuk, dan stok keluar berdasarkan kondisi barang
        if ($request->kondisi_barang_edit === "Baik") {
            // Jika stok tidak ditemukan, buat stok baru dari jumlah yang diedit
            $stok_sekarang = is_null($stok) ? $request->jumlah_barang_edit : $stok->stok + $request->jumlah_barang_edit;
            $stok_masuk = $request->jumlah_barang_edit;
            $stok_keluar = 0;
        } else if ($request->kondisi_barang_edit === "Rusak") {
            // Untuk barang rusak, kurangi stok
            $stok_sekarang = is_null($stok) ? 0 : $stok->stok - $request->jumlah_barang_edit;
            $stok_masuk = 0;
            $stok_keluar = 0;
        }

        // Update atau buat stok baru jika belum ada
        $update = Stock::where('produk_id',$retur->produks_id)->latest()->update(
            [
                'stok' => $stok_sekarang,
                'stok_masuk' => $stok_masuk,
                'stok_keluar' => $stok_keluar,
                'tanggal' => Carbon::now()->format("Y-m-d"),
            ]

        );
        
        if ($retur) {
            // Update data retur jika ditemukan
            $retur->update([
                'supplier' => $request->supplier_edit,
                'no_hp_supplier' => $request->no_hp_supplier_edit,
                'alamat_supplier' => $request->alamat_supplier_edit,
                'tgl_masuk_gudang' => $request->tgl_masuk_gudang_edit,
                'jumlah_barang' => $request->jumlah_barang_edit,
                'kondisi_barang' => $request->kondisi_barang_edit,
            ]);
        } else {
            // Jika retur tidak ditemukan, buat entri baru
            Retur::create([
                'produks_id' => $retur->id,
                'supplier' => $request->supplier_edit,
                'no_hp_supplier' => $request->no_hp_supplier_edit,
                'alamat_supplier' => $request->alamat_supplier_edit,
                'tgl_masuk_gudang' => $request->tgl_masuk_gudang_edit,
                'jumlah_barang' => $request->jumlah_barang_edit,
                'kondisi_barang' => $request->kondisi_barang_edit,
            ]);
        }
        
        if ($request->kondisi_barang_edit === "Baik") {
            Session::flash('kondisibaik', 'Laporan Stok akan Siap dalam 3 detik');
        }
        
        return redirect()->back()->with('success', 'Berhasil Memperbarui Data');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Retur::where('id',$id)->first();
        $id = $data->produks_id;
        $data->delete();
        $stok = Stock::where('produk_id',$id)->first();
        if($stok){
            $stok->delete();
        }
        Produk::where('id',$id)->delete();

        return redirect()->back()->with('success','Berhasil Hapus Data');
    }

    public function downloadLaporan()
    {
        return $this->laporanstok->generateStockReport();
    }
}
