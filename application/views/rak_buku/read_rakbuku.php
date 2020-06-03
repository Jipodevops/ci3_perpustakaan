<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<div class="my-2"></div>

<!-- button tambah data mahasiswa -->
<a href="<?php echo site_url('rakbuku/insert');?>" class="btn btn-success btn-icon-split">
	<span class="icon text-white-50">
		<i class="fas fa-plus-circle"></i>
	</span>
	<span class="text">Tambah</span>
</a>

<!-- Spacing class -->
<div class="my-2"></div>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Daftar Rak Buku</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class ="thead-dark">
					<tr>
						<th>#</th>
						<th>Kode Rak Buku</th>
						<th>Kategori</th>
						<th>Lokasi Rak</th>
                        <th>Opsi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					 $i = 1;
					 foreach($data_rak as $rak): 
					?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $rak['kode_rak']; ?></td>
							<td><?php echo $rak['kategori']; ?></td>
							<td><?php echo $rak['lokasi']; ?></td>
							<td>
								<a href="<?php echo site_url('rakbuku/update/'.$rak['kode_rak']);?>" class="btn btn-warning btn-circle">
									<i class="fas fa-edit"></i>
								</a>
	
								<a href="<?php echo site_url('rakbuku/delete/'.$rak['kode_rak']);?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" class="btn btn-danger btn-circle">
									<i class="fas fa-trash"></i>
								</a>
								<a href="<?php echo site_url('rakbuku/export/'.$rak['kode_rak']);?>" class="btn btn-primary btn-circle">
									<i class="fas fa-download"></i>
								</a>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		
		</div>
	</div>
</div>


<script>
	$(document).ready(function() {
		$('#dataTable').DataTable();
	});
</script>
