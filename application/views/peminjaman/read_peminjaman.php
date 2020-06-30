<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<div class="my-2"></div>

<!-- button tambah data mahasiswa -->
<a href="<?php echo site_url('peminjaman/insert');?>" class="btn btn-success btn-icon-split">
	<span class="icon text-white-50">
		<i class="fas fa-plus-circle"></i>
	</span>
	<span class="text">Transaksi Peminjaman</span>
</a>

<!-- Spacing class -->
<div class="my-2"></div>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Laporan Peminjaman</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class ="thead-dark">
					<tr>
						<th>#</th>
						<th>Kode Peminjaman</th>
                        <th>NIM dan Nama</th>
						<th>Tanggal Pinjam</th>
                        <th>Jatuh Tempo</th>
						<th>Status</th>
                        <th></th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
			<a href="<?php echo site_url('peminjaman/export_all');?>" class="btn btn-primary btn-icon-split">
				<span class="icon text-white-50">
					<i class="fas fa-download"></i>
				</span>
				<span class="text">Buat Laporan(Excel)</span>
			</a>
		</div>
	</div>
</div>


<script>
	$(document).ready(function() {
		table = $('#dataTable').DataTable({
			"processing" : true,
			"serverSide" : true,
			"order" : [],
			"ajax" :{
				"url" : "<?php echo site_url('Peminjaman/datatables') ?>",
				"type" : "POST"
			},
			"columnDefs" : [
				{
					"targets" : [0],
					"orderable" : false
				},
			],
		});
	});
</script>
