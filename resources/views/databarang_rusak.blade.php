@extends('layouts.app')
@section('content')
<div class="row p-4">
	<div class="col-xl-12">
		<div class="card shadow">
			<div class="card-header d-md-flex">
				<h6>Data Barang Gudang</h6>
				<div class="ms-auto">
					<button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">Buat
						Data Retur Pembelian</button>
				</div>
				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
					aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Form Buat Data Retur Pembelian</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
									aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<form action="{{route('returpembelian.store')}}" method="post" class="row">
									@csrf
									<!--
										<div class="mb-3">
											<label for="">Kode Barang</label>
											<input type="text" class="form-control" placeholder="Masukan Kode Barang">
										</div>
										<div class="mb-3">
											<label for="">Nama Barang</label>
											<input type="text" class="form-control" placeholder="Masukan Nama Barang">
										</div>
-->
									<div class="mb-3">
										<label for="">Nota Pembelian</label>
										<input type="text" name="nota_retur_pembelian" class="form-control" placeholder="Masukan Nota Pembelian">
									</div>
									<div class="mb-3">
										<label for="">Barang Yang Di Retur <span class="text-danger" style="font-size:12px;">*Data yang tampil merupakan kondisi rusak</span></label>
										<select name="retur" id="" class="form-control">
											@foreach($returs as $rt)
												<option value="{{Crypt::encrypt($rt->id)}}"> {{$rt->produk->nama_produk ?? 'Data Barang Undefined'}} ({{$rt->tgl_masuk_gudang}}) </option>
											@endforeach
										</select>
									</div>
									<div class="mb-3">
										<label for="">Tindakan Yang Diambil</label>
										<input type="text" name="tindakan" id="" class="form-control" placeholder="Tindakan Yang Diambil">
									</div>
									
									<div class="mb-3">
										<label for="">Alasan Retur</label>
										<textarea name="alasan_retur" id="" class="form-control" rows="2"></textarea>
									</div>

								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary">Buat</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="table-responsive">

					<table class="table table-striped">
						<thead>
							<tr style="font-size: 14px;">
								<th>Kode Barang</th>
								<th>Nama Barang</th>
								<th>Jenis Barang</th>
								<th>Jumlah Barang Masuk</th>
								<th>Supplier</th>
								<th>Alamat Supplier</th>
								<th>No Hp Supplier</th>
								<th>Kualitas Barang Masuk</th>
								<th>Tanggal Masuk Gudang</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($returs as $retur )
								
							<tr style="font-size:12px;">
								<td class="align-middle"> {{$retur->produk->kode_barang ?? 'N/A'}} </td>
								<td class="align-middle"> {{$retur->produk->nama_produk ?? 'N/A'}} </td>
								<td class="align-middle"> {{$retur->produk->jenis_barang ?? 'Tidak Berkategori'}} </td>
								<td class="align-middle"> {{$retur->jumlah_barang}} </td>
								<td class="align-middle"> {{$retur->supplier}} </td>
								<td class="align-middle"> {{$retur->alamat_supplier}} </td>
								<td class="align-middle"> {{$retur->no_hp_supplier}} </td>
								<td class="align-middle"> {{$retur->kondisi_barang}} </td>
								<td class="align-middle"> {{$retur->tgl_masuk_gudang}} </td>
								
							</tr>
							@endforeach
						</tbody>
					</table>
					{{-- {{ $returs->links() }} --}}
				</div>
			</div>
		</div>
	</div>
</div>
@endsection