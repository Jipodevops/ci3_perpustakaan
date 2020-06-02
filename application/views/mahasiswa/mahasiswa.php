<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<div class="my-2"></div>

<!-- button tambah data mahasiswa -->
<a href="<?php echo site_url('mahasiswa/insert');?>" class="btn btn-success btn-icon-split">
	<span class="icon text-white-50">
		<i class="fas fa-plus-circle"></i>
	</span>
	<span class="text">Buat Data</span>
</a>

<a href="<?php echo site_url('mahasiswa/export_all');?>" class="btn btn-primary btn-icon-split">
	<span class="icon text-white-50">
		<i class="fas fa-download"></i>
	</span>
	<span class="text">Cetak/Ekspor</span>
</a>


<!-- Spacing class -->
<div class="my-2"></div>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Daftar Mahasiswa</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class ="thead-dark">
					<tr>
						<th>#</th>
						<th>NIM</th>
						<th>Nama</th>
						<th>Jenis Kelamin</th>
						<th>Alamat</th>
						<th>Nomor HP</th>
                        <th>Agama</th>
                        <th>Program Studi</th>
						<th>Status</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					 $i = 1;
					 foreach($data_mahasiswa as $mhs): 
					?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $mhs['NIM']; ?></td>
							<td><?php echo $mhs['nama']; ?></td>
							<td><?php echo $mhs['jenis_kelamin']; ?></td>
							<td><?php echo $mhs['alamat']; ?></td>
							<td><?php echo $mhs['no_telepon']; ?></td>
							<td><?php echo $mhs['agama']; ?></td>
							<td><?php echo $mhs['nama_prodi']; ?></td>
							<td><?php echo $mhs['status_mahasiswa']; ?></td>
							<td>
								<a href="<?php echo site_url('mahasiswa/update/'.$mhs['NIM']);?>" class="btn btn-warning btn-circle">
									<i class="fas fa-edit"></i>
								</a>
	
								<a href="<?php echo site_url('mahasiswa/delete/'.$mhs['NIM']);?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" class="btn btn-danger btn-circle">
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
