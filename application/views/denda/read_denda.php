<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<div class="my-2"></div>

<!-- button tambah data mahasiswa -->
<a href="<?php echo site_url('denda/insert');?>" class="btn btn-success btn-icon-split">
	<span class="icon text-white-50">
		<i class="fas fa-plus-circle"></i>
	</span>
	<span class="text">Tambah</span>
</a>

<!-- Spacing class -->
<div class="my-2"></div>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Daftar Denda</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class ="thead-dark">
					<tr>
						<th>#</th>
						<th>Kode Denda</th>
						<th>Keterangan</th>
						<th>Jumlah Denda</th>
                        <th>Opsi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					 $i = 1;
					 foreach($data_denda as $data): 
					?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $data['kode_denda']; ?></td>
							<td><?php echo $data['keterangan']; ?></td>
							<td><?php echo $data['jumlah_denda']; ?></td>
							<td>
								<a href="<?php echo site_url('denda/update/'.$data['kode_denda']);?>" class="btn btn-warning btn-circle">
									<i class="fas fa-edit"></i>
								</a>
	
								<a href="<?php echo site_url('denda/delete/'.$data['kode_denda']);?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" class="btn btn-danger btn-circle">
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
