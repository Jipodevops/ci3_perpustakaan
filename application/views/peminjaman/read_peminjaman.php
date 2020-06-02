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
					</tr>
				</thead>
				<tbody>
					<?php
						$i = 1;
						foreach ($data_peminjaman as $data):
					?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $data['kode_peminjaman']; ?></td>
							<td><?php echo $data['NIM'].' - '.$data['nama']; ?></td>
							<td><?php echo $data['tanggal_pinjam']; ?></td>
							<td><?php echo $data['jatuh_tempo']; ?></td>
							<td>
								<?php
									if ($data['status'] == "N") {
										echo "Belum dikembalikan";
									}else if($data['status'] == "Y"){
										echo "Sudah dikembalikan";
									} 
									
								?>
							</td>
						</tr>
						<?php endforeach; ?>
						
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
