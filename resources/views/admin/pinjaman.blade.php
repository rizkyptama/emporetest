@extends('template.index')
@section('content')	

<div class="row">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-header border-0">
				<div class="row align-items-center">
					<div class="col">
						<h3 class="mb-0">Pengajuan Buku</h3>
					</div>
					<!-- <div class="col text-right">
						<a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ModalTambahBuku"><i class="fas fa-plus text-white mr-1"></i> Tambah Buku</a>
					</div> -->
				</div>
			</div>
			<div class="table-responsive">
				<!-- Projects table -->
				<table class="table table-bordered align-items-center table-striped table-hover table-flush text-center datatables-print" id="tblPinjam">
					<thead class="thead-light">
						<tr>
							<th>No</th>
							<th>Kode Pinjam</th>
							<th>Judul Buku</th>
							<th>Peminjam</th>
							<th>Tanggal Pinjam</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody class="list">
						<?php $no = 1; ?>
						@foreach ($pinjam as $row)
						<tr>
							<th>{{$no++}}</th>
							<td>{{$row->kd_pinjam}}</td>
							<td>{{$row->judul_buku}}</td>
							<td>{{$row->nama}}</td>
							<td>{{$row->tanggal_pinjam}}</td>
							<td>
								<button class="btn btn-primary btn-sm" type="button" onclick="detailPengajuan('{{ $row->kd_pinjam }}')" title="Detail Pengajuan"><i class="fa fa-list"></i> Detail Pengajuan</button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- The Modal Pengajuan-->
<div class="modal modal-secondary fade bd-example-modal-lg" id="ModalPengajuan">
  	<div class="modal-dialog modal-dialog-centered modal-lg">
    	<div class="modal-content">

	    	<!-- Modal Header -->
	    	<div class="modal-header">
	      		<h4 class="modal-title">Pengajuan Peminjaman Buku</h4>
	      		<button type="button" class="close" data-dismiss="modal">&times;</button>
	    	</div>

		    <!-- Modal body -->
		    <div class="modal-body">
		      	<div class="row">
		      		<input type="hidden" name="kd_buku" id="kd_buku">
			        <div class="col-lg-6">
			          	<div class="form-group">
			            	<label>Kode Pinjam</label>
			            	<input type="text" name="kd_pinjam" id="kd_pinjam" class="form-control" readonly>
			          	</div>
			        </div>
			        <div class="col-lg-6">
			          <div class="form-group">
			            <label>Status</label>
			            <input type="text" name="status" id="status" class="form-control" readonly>
			          </div>
			        </div>
			        <div class="col-lg-6">
			         	<div class="form-group">
			            	<label>Nama Peminjam</label>
				            <input type="text" name="nama" id="nama" class="form-control" readonly>
			          	</div>
			        </div>
			        <div class="col-lg-6">
			          	<div class="form-group">
			            	<label>Judul Buku</label>
			            	<input type="text" name="judul" id="judul" class="form-control" readonly>
			          	</div>
			        </div>
			        <div class="col-lg-6">
			          	<div class="form-group">
			            	<label>Tanggal Pinjam</label>
			            	<input type="text" name="tgl_pinjam" id="tgl_pinjam" class="form-control" readonly>
			          	</div>
			        </div>
			        <div class="col-lg-6">
			          <div class="form-group">
			            <label>Tanggal Kembali</label>
			            <input type="text" name="tgl_kembali" id="tgl_kembali" class="form-control"  readonly>
			          </div>
			        </div>
			    </div>
	      	</div>
	      	<!-- Modal footer -->
	      	<div class="modal-footer">
	      		<div id="stkosong">
		        	<button type="button" class="btn btn-success" onclick="approved()">Approved</button>
		        	<button type="button" class="btn btn-danger" onclick="rejected()">Rejected</button>
	      		</div>
	      		<div id="stpinjam" style="display: none">
		        	<button type="button" class="btn btn-info" onclick="dikembalikan()">Buku Di Kembalikan</button>
	      		</div>
	      	</div>
    	</div>
  	</div>
</div>

@endsection