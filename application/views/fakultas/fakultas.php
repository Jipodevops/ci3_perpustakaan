<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<div class="my-2"></div>

<!-- button tambah data mahasiswa -->
<a href="<?php echo site_url('fakultas/insert');?>" class="btn btn-success btn-icon-split">
	<span class="icon text-white-50">
		<i class="fas fa-plus-circle"></i>
	</span>
	<span class="text">Tambah</span>
</a>

<!-- Spacing class -->
<div class="my-2"></div>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Daftar Fakultas</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class ="thead-dark">
					<tr>
						<th>#</th>
						<th>Kode Fakultas</th>
						<th>Nama Fakultas</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					 $i = 1;
					 foreach($data_fakultas as $fakultas): 
					?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $fakultas['kode_fakultas']; ?></td>
							<td><?php echo $fakultas['nama_fakultas']; ?></td>
				
							<td>
								<a href="<?php echo site_url('fakultas/update/'.$fakultas['kode_fakultas']);?>" class="btn btn-warning btn-icon-split">
									<span class="text">Ubah</span>
								</a>
								&nbsp;
								<a href="<?php echo site_url('fakultas/delete/'.$fakultas['kode_fakultas']);?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" class="btn btn-danger btn-icon-split">
									<span class="text">Hapus</span>
								</a>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
			<!-- button export data fakultas -->
			<a href="<?php echo site_url('fakultas/export');?>" class="btn btn-info btn-icon-split">
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
		$('#dataTable').DataTable();
	});
</script>
