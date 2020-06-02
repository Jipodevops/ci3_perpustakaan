<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<div class="my-2"></div>

<!-- button tambah data mahasiswa -->
<a href="<?php echo site_url('petugas/insert');?>" class="btn btn-success btn-icon-split">
	<span class="icon text-white-50">
		<i class="fas fa-plus-circle"></i>
	</span>
	<span class="text">Buat Data</span>
</a>

<!-- Spacing class -->
<div class="my-2"></div>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Daftar Petugas</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class ="thead-dark">
					<tr>
						<th>#</th>
						<th>ID Petugas</th>
						<th>Nama</th>
						<th>Username</th>
						<th>Jenis Kelamin</th>
                        <th>Alamat</th>
                        <th>Nomor HP</th>
                        <th>Opsi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					 $i = 1;
					 foreach($data_petugas as $data): 
					?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $data['id_petugas']; ?></td>
							<td><?php echo $data['nama']; ?></td>
							<td><?php echo $data['username']; ?></td>
							<td><?php echo $data['jenis_kelamin']; ?></td>
                            <td><?php echo $data['alamat']; ?></td>
                            <td><?php echo $data['no_telepon']; ?></td>
							<td>
								<a href="<?php echo site_url('petugas/update/'.$data['id_petugas']);?>" class="btn btn-warning btn-circle">
									<i class="fas fa-edit"></i>
								</a>
	
								<a href="<?php echo site_url('petugas/delete/'.$data['id_petugas']);?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" class="btn btn-danger btn-circle">
									<i class="fas fa-trash"></i>
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
