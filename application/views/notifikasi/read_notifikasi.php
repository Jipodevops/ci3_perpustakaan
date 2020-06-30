<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<div class="my-2"></div>


<!-- Spacing class -->
<div class="my-2"></div>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">SMS Notifikasi</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class ="thead-dark">
					<tr>
						<th>#</th>
						<th>NIM</th>
						<th>Nama</th>
						<th>No. HP</th>
						<th>Kode Peminjaman</th>
						<th>Pesan</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
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
				"url" : "<?php echo site_url('notifikasi/datatables') ?>",
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
