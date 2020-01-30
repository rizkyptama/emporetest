@extends('template.index')
@section('content')	

<div class="row">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-header border-0">
				<div class="row align-items-center">
					<div class="col">
						<h3 class="mb-0">Data Anggota</h3>
					</div>
					<div class="col text-right">
						<a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ModalTambahUser"><i class="fas fa-plus text-white mr-1"></i> Tambah Anggota</a>
					</div>
				</div>
			</div>
			<div class="table-responsive">
				<!-- Projects table -->
				<table class="table table-bordered align-items-center table-striped table-hover table-flush text-center datatables-print" id="tblAnggota">
					<thead class="thead-light">
						<tr>
							<th>No</th>
							<th>Nama Anggota</th>
							<th>No Handphone</th>
							<th>Email</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody class="list">
						<?php $no = 1; ?>
						@foreach ($anggota as $row)
						<tr>
							<th>{{$no++}}</th>
							<td>{{$row->nama}}</td>
							<td>{{$row->no_hp}}</td>
							<td>{{$row->email}}</td>
							<td>
								<button class="btn btn-warning btn-sm" type="button" onclick="editUser('{{ $row->kd_user }}')" title="Ubah Data"><i class="fa fa-edit"></i></button>
								<button class="btn btn-danger btn-sm" type="button" onclick="deleteUser('{{ $row->kd_user }}')" title="Hapus Data"><i class="fa fa-trash"></i></button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- The Modal Tambah-->
<div class="modal modal-secondary fade bd-example-modal-lg" id="ModalTambahUser">
  	<div class="modal-dialog modal-dialog-centered modal-lg">
    	<div class="modal-content">

	    	<!-- Modal Header -->
	    	<div class="modal-header">
	      		<h4 class="modal-title">Tambah Data Anggota</h4>
	      		<button type="button" class="close" data-dismiss="modal">&times;</button>
	    	</div>

		    <!-- Modal body -->
		    <div class="modal-body">
		      	<div class="row">
			        <div class="col-lg-12">
			          	<div class="form-group">
			            	<label>Nama Anggota</label>
			            	<input type="text" name="nama" id="nama" class="form-control">
			          	</div>
			        </div>
			        <div class="col-lg-6">
			         	<div class="form-group">
			            	<label>No Handphone</label>
				            <input type="number" name="nohp" id="nohp" class="form-control">
			          	</div>
			        </div>
			        <div class="col-lg-6">
			          	<div class="form-group">
			            	<label>Email</label>
			            	<input type="text" name="email" id="email" class="form-control">
			          	</div>
			        </div>
			        <div class="col-lg-6">
			          	<div class="form-group">
			            	<label>UserName</label>
			            	<input type="text" name="username" id="username" class="form-control">
			          	</div>
			        </div>
			        <div class="col-lg-6">
			          <div class="form-group">
			            <label>Password</label>
			            <input type="text" name="password" id="password" class="form-control">
			          </div>
			        </div>
			    </div>
	      	</div>
	      	<!-- Modal footer -->
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-lin mr-auto" data-dismiss="modal">Tutup</button>
	        	<button type="button" class="btn btn-info" onclick="tambahUser()">Simpan</button>
	      	</div>
    	</div>
  	</div>
</div>

<!-- The Modal Update-->
<div class="modal modal-secondary fade bd-example-modal-lg" id="ModalEditUser">
  	<div class="modal-dialog modal-dialog-centered modal-lg">
    	<div class="modal-content">

	    	<!-- Modal Header -->
	    	<div class="modal-header">
	      		<h4 class="modal-title">Ubah Data Anggota</h4>
	      		<button type="button" class="close" data-dismiss="modal">&times;</button>
	    	</div>

		    <!-- Modal body -->
		    <div class="modal-body">
		      	<div class="row">
		      		<input type="hidden" name="kd_user" id="kd_user">
			        <div class="col-lg-6">
			          	<div class="form-group">
			            	<label>Nama Anggota</label>
			            	<input type="text" name="enama" id="enama" class="form-control">
			          	</div>
			        </div>
			        <div class="col-lg-6">
			          	<div class="form-group">
			            	<label>UserName</label>
			            	<input type="text" name="eusername" id="eusername" class="form-control">
			          	</div>
			        </div>
			        <div class="col-lg-6">
			         	<div class="form-group">
			            	<label>No Handphone</label>
				            <input type="number" name="enohp" id="enohp" class="form-control">
			          	</div>
			        </div>
			        <div class="col-lg-6">
			          	<div class="form-group">
			            	<label>Email</label>
			            	<input type="text" name="eemail" id="eemail" class="form-control">
			          	</div>
			        </div>
			    </div>
	      	</div>
	      	<!-- Modal footer -->
	      	<div class="modal-footer">
	        	<button type="button" class="btn btn-lin mr-auto" data-dismiss="modal">Tutup</button>
	        	<button type="button" class="btn btn-info" onclick="updateUser()">Update</button>
	      	</div>
    	</div>
  	</div>
</div>

@endsection