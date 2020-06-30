<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<div class="my-2"></div>

<!-- button tambah data mahasiswa -->
<a href="<?php echo site_url('buku/insert');?>" class="btn btn-success btn-icon-split">
	<span class="icon text-white-50">
		<i class="fas fa-plus-circle"></i>
	</span>
	<span class="text">Tambah</span>
</a>

<!-- Spacing class -->
<div class="my-2"></div>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Koleksi Buku</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class ="thead-dark">
					<tr>
						<th>#</th>
						<th>ID Buku</th>
						<th>Judul</th>
						<th>Penulis</th>
						<th>Penerbit</th>
						<th>Tahun Terbit</th>
                        <th>Jumlah Buku</th>
                        <th>Kategori</th>
                        <th>Lokasi Rak</th>
                        <th>Sampul Buku</th>
                        <th>Opsi</th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
            <!-- button export data buku -->
			<a href="<?php echo site_url('buku/export');?>" class="btn btn-info btn-icon-split">
				<span class="icon text-white-50">
					<i class="fas fa-download"></i>
				</span>
				<span class="text">Cetak/Ekspor</span>
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
				"url" : "<?php echo site_url('buku/datatables') ?>",
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

