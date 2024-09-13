@extends('layouts.app')
@section('content')
<div class="row p-4">
	<div class="col-xl-12">
		<div class="card shadow">
			<div class="card-header d-md-flex">
				<h6>Data Barang Gudang</h6>
			</div>
			<div class="card-body">
				<div class="table-responsive">

					<table class="table table-striped">
						<thead>
							<tr style="font-size: 14px;">
								<th>Nota Retur Pembelian</th>
								<th>Kode Barang</th>
								<th>Nama Barang</th>
								<th>Jenis Barang</th>
								<th>Jumlah Barang</th>
								<th>Supplier</th>
								<th>Alamat Supplier</th>
								<th>No Hp Supplier</th>
								<th>Kualitas Barang Masuk</th>
								<th>Tanggal Barang Datang</th>
                                <th>Alasan Retur</th>
                                <th>Tindakan</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($returs as $retur )
								
							<tr style="font-size:12px;">
								<td class="align-middle"> {{$retur->nota_retur_pembelian ?? 'N/A'}} </td>
								<td class="align-middle"> {{$retur->retur->produk->kode_barang ?? 'N/A'}} </td>
								<td class="align-middle"> {{$retur->retur->produk->nama_produk ?? 'N/A'}} </td>
								<td class="align-middle"> {{$retur->retur->produk->jenis_barang ?? 'Tidak Berkategori'}} </td>
								<td class="align-middle"> {{$retur->retur->jumlah_barang}} </td>
								<td class="align-middle"> {{$retur->retur->supplier}} </td>
								<td class="align-middle"> {{$retur->retur->alamat_supplier}} </td>
								<td class="align-middle"> {{$retur->retur->no_hp_supplier}} </td>
								<td class="align-middle"> {{$retur->retur->kondisi_barang}} </td>
								<td class="align-middle"> {{$retur->retur->tgl_masuk_gudang}} </td>
								<td class="align-middle"> {{$retur->alasan_retur}} </td>
								<td class="align-middle"> {{$retur->tindakan}} </td>
								<td class="align-middle">
									<div class="d-flex">
										@if ($retur->retur->kondisi_barang == "Rusak(Sudah Diproses)")
											<div class="text-center bg-primary rounded-pill text-white"> {{$retur->retur->kondisi_barang ?? 'N/A'}} </div>
										@else
											@if (Auth::user()->id_role === 3)
											<button type="button" class="btn btn-sm btn-primary text-white" onclick="window.location.href='{{route('retur.kirim',Crypt::encrypt($retur->retur->id))}}'"> Entri Barang Keluar </button>
											@else
											<button type="button" class="btn btn-sm btn-warning text-white ms-2" data-bs-toggle="modal" data-bs-target="#editModal{{$retur->id}}">Edit</button>
											<button type="button" class="btn btn-sm btn-danger text-white ms-2" onclick="window.location.href='{{route('returpembelian.destroy',$retur->id)}}'">Hapus</button>

											<div class="modal fade" id="editModal{{$retur->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$retur->id}}" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-lg">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLabel{{$retur->id}}">Form Edit Data Retur</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal"
																aria-label="Close"></button>
														</div>
														<div class="modal-body">
															<form action="{{route('returpembelian.update')}}" method="post" class="row">
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
																<div class="mb-3 col-xl-6">
																	<label for="">Nota Pembelian</label>
																	<input type="text" name="nota_retur_pembelian_edit" class="form-control" placeholder="Masukan Nota Pembelian" value="{{$retur->nota_retur_pembelian}}">
																</div>
																<div class="mb-3 col-xl-6">
																	<label for="">Barang Yang Di Retur <span class="text-danger" style="font-size:12px;">*Data yang tampil merupakan kondisi rusak</span> </label>
																	<select name="retur_edit" id="" class="form-control">
																		@foreach($ret as $rt)
																			<option value="{{Crypt::encrypt($rt->id)}}" {{ $rt->id === $retur->retur_id  ? 'selected' : ''}} > {{$rt->produk->nama_produk ?? 'Data Barang Undefined'}} ({{$rt->tgl_masuk_gudang}}) </option>
																		@endforeach
																	</select>
																</div>
																<div class="mb-3">
																	<label for="">Tindakan Yang Diambil</label>
																	<input type="text" name="tindakan_edit" id="" class="form-control" placeholder="Tindakan Yang Diambil" value="{{$retur->tindakan}}">
																</div>
																
																<div class="mb-3">
																	<label for="">Alasan Retur</label>
																	<textarea name="alasan_retur_edit" id="" class="form-control" rows="2">{{$retur->alasan_retur}}</textarea>
																</div>
							
															</div>
															<div class="modal-footer">
																<button type="submit" class="btn btn-primary">Buat</button>
															</div>
														</form>
													</div>
												</div>
											</div>
											@endif
										@endif
									</div>
								</td>
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