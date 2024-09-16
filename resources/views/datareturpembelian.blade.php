@extends('layouts.app')
@section('content')
<div class="row p-4">
	<div class="col-xl-12">
		<div class="card shadow">
			<div class="card-header d-md-flex">
				<h6>Data Retur Pembelian</h6>
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
						<tbody id='datanya'>
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
										<div class="text-center bg-primary rounded-pill text-white"> Dalam Pengiriman Ke Supplier </div>
										@else
										@if (Auth::user()->id_role === 3)
											<button type="button" class="btn btn-sm btn-primary text-white krim" data-id="{{Crypt::encrypt($retur->retur->id)}}"> Entri Barang Keluar </button>
											@else
											<button type="button" class="btn btn-sm btn-warning text-white ms-2" data-bs-toggle="modal" data-bs-target="#editModal{{$retur->id}}"> <i class="fa fa-pen-to-square"></i> Edit</button>
											<button type="button" class="btn btn-sm btn-danger text-white ms-2" onclick="window.location.href='{{route('returpembelian.destroy',$retur->id)}}'"> <i class="fa fa-trash-can"></i> Hapus</button>

											<div class="modal fade" id="editModal{{$retur->id}}" tabindex="-1" aria-labelledby="exampleModalLabel{{$retur->id}}" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered modal-lg">
													<div class="modal-content">
														<div class="modal-header">
															<h5 class="modal-title" id="exampleModalLabel{{$retur->id}}">Form Edit Data Retur</h5>
															<button type="button" class="btn-close" data-bs-dismiss="modal"
																aria-label="Close"></button>
														</div>
														<div class="modal-body">
															<form action="{{route('returpembelian.update',['id' => $retur->id])}}" method="post" class="row">
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
																<button type="submit" class="btn btn-primary">Ubah</button>
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
@section('js')
<script>
    $(document).ready(function(){
        $('.krim').on('click', function(){
			var id = $(this).data('id');
            $.ajax({
                url: "{{ route('retur.kirim', '') }}/" + id,
                type: "GET",
                success: function(data){
					var html = '';
					for(i = 0; i < data.data.length; i++) {
						var retur = data.data[i];
						// console.log(retur.retur.kondisi_barang);
						var produk = retur.retur.produk || {};  // Ambil produk dari retur, jika ada
						// Buat HTML untuk setiap baris
						html += `
							<tr style="font-size:12px;">
								<td class="align-middle"> ${retur.nota_retur_pembelian ?? 'N/A'} </td>
								<td class="align-middle"> ${produk.kode_barang ?? 'N/A'} </td>
								<td class="align-middle"> ${produk.nama_produk ?? 'N/A'} </td>
								<td class="align-middle"> ${produk.jenis_barang ?? 'Tidak Berkategori'} </td>
								<td class="align-middle"> ${retur.retur.jumlah_barang} </td>
								<td class="align-middle"> ${retur.retur.supplier} </td>
								<td class="align-middle"> ${retur.retur.alamat_supplier} </td>
								<td class="align-middle"> ${retur.retur.no_hp_supplier} </td>
								<td class="align-middle"> ${retur.retur.kondisi_barang} </td>
								<td class="align-middle"> ${retur.retur.tgl_masuk_gudang} </td>
								<td class="align-middle"> ${retur.alasan_retur} </td>
								<td class="align-middle"> ${retur.tindakan} </td>
								<td class="align-middle">
									<div class="d-flex">
										${(retur.retur.kondisi_barang === "Rusak(Sudah Diproses)") 
											? '<div class="text-center bg-primary rounded-pill text-white">Dalam Pengiriman Ke Supplier</div>' 
											: (data.user_role === 3) // Sesuaikan pengecekan role di sini
											? '<button type="button" class="btn btn-sm btn-primary text-white krim" data-id="'+ retur.id +'">Entri Barang Keluar</button>' 
											: ''
										}
									</div>
								</td>
							</tr>
						`;
					}

					$('#datanya').html(html);
                    Swal.fire({
            		    icon: data.status,
            		    title: 'Berhasil',
            		    text: data.message,
            		});

					if(data.status == "success")
					{
						console.log('{{route("retur.getBarangKeluar")}}');
						window.location.href='{{route("retur.getBarangKeluar")}}';
					}
                },
                error: function(xhr, status, error) {
					Swal.fire({
            		    icon: 'error',
            		    title: 'Error',
            		    text: xhr.responseText,
            		});
                }
            });
        });
    });
</script>
@endsection
