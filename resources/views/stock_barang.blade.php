
@extends('layouts.app')
@section('content')
<div class="row p-4">
	<div class="col-xl-12">
		<div class="card shadow">
			<div class="card-header d-md-flex">
				<h6>Data Laporan Stok Barang</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">

					<table class="table table-striped">
						<thead>
							<tr style="font-size: 14px;">
								<th>Kode Barang</th>
								<th>Nama Barang</th>
								<th>Jenis Barang</th>
								<th>Tanggal Barang Datang</th>
								<th>Stok</th>
								<th>Stok Masuk</th>
								<th>Stok Keluar</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($stock as $st )
							<tr style="font-size:12px;">
								<td class="align-middle"> {{$st->retur->produk->kode_barang ?? 'N/A'}} </td>
								<td class="align-middle"> {{$st->retur->produk->nama_produk ?? 'N/A'}} </td>
								<td class="align-middle"> {{$st->retur->produk->jenis_barang ?? 'Tidak Berkategori'}} </td>
								<td class="align-middle"> {{$st->retur->tgl_masuk_gudang}} </td>
								<td class="align-middle"> {{$st->stok}} </td>
								<td class="align-middle"> {{$st->stok_masuk}} </td>
								<td class="align-middle"> {{$st->stok_keluar}} </td>
							</tr>
							@endforeach
						</tbody>
					</table>
					{{ $stock->links() }}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection