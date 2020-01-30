@extends('template.index')
@section('content')	

<div class="row">
	<div class="col-xl-12">
		<div class="card">
			<div class="card-header border-0">
				<div class="row align-items-center">
					<div class="col">
						<h3 class="mb-0">Peminjaman Buku</h3>
					</div>
					<!-- <div class="col text-right">
						<a href="#" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#ModalTambahBuku"><i class="fas fa-plus text-white mr-1"></i> Tambah Buku</a>
					</div> -->
				</div>
			</div>
			<div class="table-responsive">
				<!-- Projects table -->
				<table class="table table-bordered align-items-center table-striped table-hover table-flush text-center datatables-print" id="tblBuku">
					<thead class="thead-light">
						<tr>
							<th>No</th>
							<th>Judul Buku</th>
							<th>Pengarang</th>
							<th>Tahun Terbit</th>
							<th>Stok</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody class="list">
						<?php $no = 1; ?>
						@foreach ($buku as $row)
						<tr>
							<th>{{$no++}}</th>
							<td>{{$row->judul_buku}}</td>
							<td>{{$row->pengarang}}</td>
							<td>{{$row->tahun_terbit}}</td>
							<td>{{$row->stok_buku}}</td>
							<td>
								<button class="btn btn-primary btn-sm" type="button" onclick="detailPinjam('{{ $row->kd_buku }}')" title="Pinjam Buku"><i class="fa fa-handshake"></i> Pinjam Buku</button>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- The Modal Detail-->
<div class="modal modal-secondary fade bd-example-modal-lg" id="ModalDetailPinjam">
  	<div class="modal-dialog modal-dialog-centered modal-lg">
    	<div class="modal-content">

	    	<!-- Modal Header -->
	    	<div class="modal-header">
	      		<h4 class="modal-title">Pinjam Buku Baru</h4>
	      		<button type="button" class="close" data-dismiss="modal">&times;</button>
	    	</div>

		    <!-- Modal body -->
		    <div class="modal-body">
		      	<div class="row">
		      		<input type="hidden" name="kd_buku" id="kd_buku">
			        <div class="col-lg-6">
			          	<div class="form-group">
			            	<label>Judul Buku</label>
			            	<input type="text" name="judul" id="judul" class="form-control" readonly>
			          	</div>
			        </div>
			        <div class="col-lg-6">
			         	<div class="form-group">
			            	<label>Pengarang</label>
				            <input type="text" name="pengarang" id="pengarang" class="form-control" readonly>
			          	</div>
			        </div>
			        <div class="col-lg-6">
			          	<div class="form-group">
			            	<label>Penerbit</label>
			            	<input type="text" name="penerbit" id="penerbit" class="form-control" readonly>
			          	</div>
			        </div>
			        <div class="col-lg-6">
			          	<div class="form-group">
			            	<label>Tahun Terbit</label>
			            	<input type="number" name="tahun_terbit" id="tahun_terbit" class="form-control" readonly>
			          	</div>
			        </div>
			        <div class="col-lg-4">
			          <div class="form-group">
			            <label>Stok Buku</label>
			            <input type="number" name="stok" id="stok" class="form-control" readonly>
			          </div>
			        </div>
			        <div class="col-lg-4">
			          <div class="form-group">
			            <label>No Rak Buku</label>
			            <input type="number" name="norak" id="norak" class="form-control" readonly>
			          </div>
			        </div>
			        <div class="col-lg-4">
			          <div class="form-group">
			            <label>Kategori Buku</label>
			            <input type="text" name="kategori" id="kategori" class="form-control" readonly>
			          </div>
			        </div>
			    </div>
	      	</div>
	      	<!-- Modal footer -->
	      	<div class="modal-footer">
	      		<table class="table-borderless" style="width: 100%">
	      			<tr>
	      				<th><h3>Tanggal Pinjam</h3></th>
	      				<th><h3>Tanggal Kembali</h3></th>
	      				<th></th>
	      			</tr>
	      			<tr>
	      				<td>
	      					<input type="date" name="tgl_pinjam" id="tgl_pinjam" class="form-control" style="width: 85%">
	      				</td>
	      				<td>
				        	<input type="date" name="tgl_kembali" id="tgl_kembali" class="form-control" style="width: 85%">
				        </td>
				        <td>
	        				<button type="button" class="btn btn-info" style="width: 85%" onclick="pinjam()">Ajukan Pinjaman</button>
	        			</td>
	      			</tr>
	      		</table>	        	
	      	</div>
    	</div>
  	</div>
</div>

@endsection