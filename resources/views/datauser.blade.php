@extends('layouts.app')
@section('content')
<div class="row p-4">
  <div class="card shadow">
    <div class="card-header d-md-flex">
      <h6>Data User</h6>
      <button class="btn btn-primary btn-sm" data-bs-toggle='modal' data-bs-target="#buatUser">Buat Akun User</button>
      
      <div class="modal fade" id="buatUser" tabindex="-1" aria-labelledby="buatUserLabel"
					aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">
								  </h5>
							</div>
							<div class="modal-body">
							  <form action="#" method="POST">
							    @csrf
							    <div class="mb-3">
							      <label>Username</label>
							      <input type="text" class="form-control" name="username" placeholder="Masukan Username">
							    </div>
							    <div class="mb-3">
							      <label>E-Mail</label>
							      <input type="email" class="form-control" name="email" placeholder="Masukan Email">
							    </div>
							    <div class="mb-3">
							      <label>Password</label>
							      <input type="password" class="form-control" name="password" placeholder="Masukan Password">
							    </div>
							    <div class="mb-3">
							      <label>Akun Bagian</label>
							       <select class="form-control" name="role">
							         @foreach($role as $rl)
							         <option value="{{$rl->id}}">{{ $rl->nama_role}}</option>
							         @endforeach
							       </select>
							    </div>
							    <button type="submit" class="btn btn-primary btn-sm">Buat Akun</button>
							  </form>
							</div>
						</div>
					</div>
      </div>
    </div>
    <div class="card-body">
      <table class="table table-stripped table-responsive">
        <thead>
          <tr>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach($user as $sr)
          <tr>
            <td>{{$sr->username}}</td>
            <td>{{$sr->email}}</td>
            <td>{{$sr->role->nama_role ?? 'N/A'}}</td>
            <td>
              <div class="d-flex">
                <button class="btn btn-warning btn-sm" type="button" data-bs-toggle='modal' data-bs-target="editUser{{$sr->id}}">Edit User</button>
                <button type="button" class="btn btn-danger btn-sm" onclick="window.location.href='{{route(sr.hapus,$sr->id)}}'">Hapus User</button>
                <div class="modal fade" id="editUser{{$sr->id}}" tabindex="-1" aria-labelledby="buatUserLabel"
					aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">
								  </h5>
							</div>
							<div class="modal-body">
							  <form action="{{route('data.upsr',['id'=>Crypt::encrypt($sr->id)])}}" method="POST">
							    @csrf
							    <div class="mb-3">
							      <label>Username</label>
							      <input type="text" class="form-control" name="username_edit" placeholder="Masukan Username">
							    </div>
							    <div class="mb-3">
							      <label>E-Mail</label>
							      <input type="email_edit" class="form-control" name="email" placeholder="Masukan Email">
							    </div>
							    <div class="mb-3">
							      <label>Password</label>
							      <input type="password_edit" class="form-control" name="password" placeholder="Masukan Password">
							    </div>
							    <div class="mb-3">
							      <label>Akun Bagian</label>
							       <select class="form-control" name="role_edit">
							         @foreach($role as $rl)
							         <option value="{{$rl->id}}" {{sr->id_role === $rl->id ? 'selected':''}}>{{ $rl->nama_role}}</option>
							         @endforeach
							       </select>
							    </div>
							    <button type="submit" class="btn btn-primary btn-sm">Edit Akun</button>
							  </form>
							</div>
						</div>
              </div>
            </td>
            
          </tr>
          @endforeach
          
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection