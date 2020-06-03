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
					<?php
						$i = 1;
						foreach ($data_peminjaman as $data):
					?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $data['kode_peminjaman']; ?></td>
							<td><?php echo $data['NIM'].' - '.$data['nama']; ?></td>
							<td><?php echo date("l, d-m-Y", strtotime($data['tanggal_pinjam'])); ?></td>
							<td><?php echo date("l, d-m-Y", strtotime($data['jatuh_tempo'])); ?></td>
							<td>
								<?php
									if ($data['status'] == "N") {
										echo "
										<div class='btn btn-warning btn-icon-split btn-sm'>
											<span class='icon text-white-40'>
											<i class='fas fa-exclamation-triangle'></i>
											</span>
											<span class='text'>Belum dikembalikan</span>
										</div>
										";
									}else if($data['status'] == "Y"){
										echo "
										<div class='btn btn-primary btn-icon-split btn-sm'>
											<span class='icon text-white-50'>
											<i class='fas fa-check'></i>
											</span>
											<span class='text'>Sudah dikembalikan</span>
										</div>
										";
									} 	
								?>
							</td>
							<td>
								<a href="<?php echo site_url('detail_peminjaman/read/'.$data['kode_peminjaman'])?>" class='btn btn-info btn-icon-split btn-sm'>
									<span class='icon text-white-50'>
									<i class='fas fa-search'></i>
									</span>
								</a>
								&nbsp;
								<a href="<?php echo site_url('peminjaman/delete/'.$data['kode_peminjaman'])?>" onclick="return confirm('Yakin akan menghapus data ini ?')" class='btn btn-danger btn-icon-split btn-sm'>
									<span class='icon text-white-50'>
									<i class='fas fa-trash'></i>
									</span>
								</a>
							</td>
						</tr>
						<?php endforeach; ?>
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
		$('#dataTable').DataTable();
	});
</script>
