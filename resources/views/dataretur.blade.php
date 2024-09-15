@extends('layouts.app')
@section('content')
<div class="row p-4">
	<div class="col-xl-12">
		<div class="card shadow">
			<div class="card-header d-md-flex">
				<h6>Data Barang Gudang</h6>
				<div class="ms-auto">
					<button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal"> <i class="fa fa-plus"></i> Buat
						Data Barang Masuk</button>
				</div>
				<!-- Modal -->
				<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
					aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Form Pendataan Barang</h5>
								<button type="button" class="btn-close" data-bs-dismiss="modal"
									aria-label="Close"></button>
							</div>
							<div class="modal-body">
								<form action="{{ route('retur.store') }}" method="post" class="row">
									@csrf
									<div class="mb-3">
										<label for="">Kode Barang</label>
										<input type="text" name="kode_barang" class="form-control @error('kode_barang') is-invalid @enderror" placeholder="Masukan Kode Barang" value="{{ old('kode_barang') }}">
										@error('kode_barang')
										<div class="invalid-feedback">{{ $message }}</div>
										@enderror
									</div>
								
									<div class="mb-3">
										<label for="">Nama Barang</label>
										<input type="text" name="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror" placeholder="Masukan Nama Barang" value="{{ old('nama_produk') }}">
										@error('nama_produk')
										<div class="invalid-feedback">{{ $message }}</div>
										@enderror
									</div>
								
									<div class="mb-3 col-xl-6">
										<label for="">Jenis Barang</label>
										<input type="text" name="jenis_barang" class="form-control @error('jenis_barang') is-invalid @enderror" placeholder="Masukan Jenis Barang" value="{{ old('jenis_barang') }}">
										@error('jenis_barang')
										<div class="invalid-feedback">{{ $message }}</div>
										@enderror
									</div>
								
									<div class="mb-3 col-xl-6">
										<label for="">Harga Per Produk</label>
										<input type="numeric" name="harga_produk" class="form-control @error('harga_produk') is-invalid @enderror" placeholder="Masukan Harga Produk" value="{{ old('harga_produk') }}">
										@error('harga_produk')
										<div class="invalid-feedback">{{ $message }}</div>
										@enderror
									</div>
								
									<div class="mb-3 col-xl-6">
										<label for="">Supplier</label>
										<input type="text" name="supplier" class="form-control @error('supplier') is-invalid @enderror" placeholder="Masukan Nama Supplier" value="{{ old('supplier') }}">
										@error('supplier')
										<div class="invalid-feedback">{{ $message }}</div>
										@enderror
									</div>
								
									<div class="mb-3 col-xl-6">
										<label for="">No HP Supplier</label>
										<input type="text" class="form-control @error('no_hp_supplier') is-invalid @enderror" minlength="6" maxlength="13" name="no_hp_supplier" placeholder="Contoh : 08123456789" value="{{ old('no_hp_supplier') }}">
										@error('no_hp_supplier')
										<div class="invalid-feedback">{{ $message }}</div>
										@enderror
									</div>
								
									<div class="mb-3">
										<label for="">Alamat Supplier</label>
										<textarea class="form-control @error('alamat_supplier') is-invalid @enderror" rows="3" name="alamat_supplier" placeholder="Masukan alamat supplier">{{ old('alamat_supplier') }}</textarea>
										@error('alamat_supplier')
										<div class="invalid-feedback">{{ $message }}</div>
										@enderror
									</div>
								
									<div class="mb-3 col-xl-4">
										<label for="">Tanggal Retur</label>
										<input type="date" class="form-control @error('tgl_masuk_gudang') is-invalid @enderror" name="tgl_masuk_gudang" value="{{ old('tgl_masuk_gudang') }}">
										@error('tgl_masuk_gudang')
										<div class="invalid-feedback">{{ $message }}</div>
										@enderror
									</div>
								
									<div class="mb-3 col-xl-4">
										<label for="">Jumlah Barang</label>
										<input type="number" class="form-control @error('jumlah_barang') is-invalid @enderror" name="jumlah_barang" placeholder="Masukan Jumlah Retur" value="{{ old('jumlah_barang') }}">
										@error('jumlah_barang')
										<div class="invalid-feedback">{{ $message }}</div>
										@enderror
									</div>
								
									<div class="mb-3 col-xl-4">
										<label for="">Kondisi Barang</label>
										<select class="form-control @error('kondisi_barang') is-invalid @enderror" name="kondisi_barang">
											<option value="Baik" {{ old('kondisi_barang') == 'Baik' ? 'selected' : '' }}>Baik</option>
											<option value="Rusak" {{ old('kondisi_barang') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
										</select>
										@error('kondisi_barang')
										<div class="invalid-feedback">{{ $message }}</div>
										@enderror
									</div>
								
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary">Buat</button>
									</div>
								</form>
							</div>								
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
								<th>Aksi</th>
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
								<td class="align-middle">
									<div class="d-flex">
										@if (Auth::user()->id_role === 1)
											@php
												$disabled = 'disabled';
											@endphp
										@else
											@php
												$disabled = '';
											@endphp
										@endif
										<button type="button" class="btn btn-sm btn-warning text-white ms-2" data-bs-toggle="modal" data-bs-target="#editModal{{$retur->id}}" {{$disabled}}> <i class="fa fa-pen-to-square"></i> Edit</button>
										<button type="button" class="btn btn-sm btn-danger text-white ms-2" onclick="window.location.href='{{route('retur.destroy',$retur->id)}}'" {{$disabled}}> <i class="fa fa-trash-can"></i> Hapus</button>

										<div class="modal fade" id="editModal{{$retur->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$retur->id}}" aria-hidden="true">
											<div class="modal-dialog modal-dialog-centered modal-lg">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel{{$retur->id}}">Form Edit Pendataan Barang</h5>
														<button type="button" class="btn-close" data-bs-dismiss="modal"
															aria-label="Close"></button>
													</div>
													<div class="modal-body">
														<form action="{{route('retur.update')}}" method="post" class="row">
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
															<input type="hidden" name="jkUgdw720P62" value="{{Crypt::encrypt($retur->id)}}">
															<div class="mb-3">
																<label for="">Kode Barang</label>
																<input type="text" name="kode_barang_edit" class="form-control" placeholder="Masukan Kode Barang" value="{{$retur->produk->kode_barang}}">
															</div>
															<div class="mb-3">
																<label for="">Nama Barang</label>
																<input type="text" name="nama_produk_edit" class="form-control" placeholder="Masukan Kode Barang" value="{{$retur->produk->nama_produk}}">
															</div>
															<div class="mb-3 col-xl-6">
																<label for="">Jenis Barang</label>
																<input type="text" name="jenis_barang_edit" class="form-control" placeholder="Masukan Kode Barang" value="{{$retur->produk->jenis_barang}}">
															</div>
															<div class="mb-3 col-xl-6">
																<label for="">Harga Per Produk</label>
																<input type="numeric" name="harga_produk_edit" class="form-control" placeholder="Masukan Kode Barang" value="{{$retur->produk->harga_produk}}">
															</div>
															<div class="mb-3 col-xl-6">
																<label for="">Supplier</label>
																<input type="text" name="supplier_edit"class="form-control" placeholder="Masukan Nama supplier" value="{{$retur->supplier}}">
															</div>
															<div class="mb-3 col-xl-6">
																<label for="">No HP Supplier</label>
																<input type="text" class="form-control" minlength="6" maxlength="13" name="no_hp_supplier_edit" placeholder="Contoh : 08123456789" value="{{$retur->no_hp_supplier}}">
															</div>
															<div class="mb-3">
																<label for="">Alamat Supplier</label>
																<textarea class="form-control" rows="3" name="alamat_supplier_edit"
																	placeholder="masukan alamat supplier">{{$retur->alamat_supplier}}</textarea>
															</div>
															<div class="mb-3 col-xl-4">
																<label for="">Tanggal Retur</label>
																<input type="date" class="form-control" name="tgl_masuk_gudang_edit" placeholder="Masukan Tanggal Barang" value="{{$retur->tgl_barang_masuk}}">
															</div>
															<div class="mb-3 col-xl-4">
																<label for="">Jumlah Barang</label>
																<input type="number" class="form-control" name="jumlah_barang_edit" placeholder="Masukan Jumlah Retur" value="{{$retur->jumlah_barang}}">
															</div>
															<div class="mb-3 col-xl-4">
																<label for="">Kondisi Barang</label>
																<select class="form-control" name="kondisi_barang_edit">
																	<option value="Baik" {{$retur->kondisi_barang == "Baik" ? 'selected' : ''}}>Baik</option>
																	<option value="Rusak"{{$retur->kondisi_barang == "Rusak" ? 'selected' : ''}}>Rusak</option>
																</select>
															</div>
														</div>
														<div class="modal-footer">
															<button type="submit" class="btn btn-success">Ubah</button>
														</div>
													</form>
												</div>
											</div>
										</div>
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