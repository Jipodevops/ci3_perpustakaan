<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<div class="my-2"></div>

<!-- button tambah data mahasiswa -->
<a href="<?php echo site_url('pengembalian/insert');?>" class="btn btn-success btn-icon-split">
	<span class="icon text-white-50">
		<i class="fas fa-plus-circle"></i>
	</span>
	<span class="text">Transaksi Pengembalian</span>
</a>

<!-- Spacing class -->
<div class="my-2"></div>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Laporan Pengembalian</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class ="thead-dark">
					<tr>
						<th>#</th>
						<th>Kode Pengembalian</th>
						<th>Tanggal Pengembalian</th>
                        <th>Kode Peminjaman</th>
                        <th>NIM dan Nama</th>
						<th>Tanggal Peminjaman</th>
						<th>Keterangan Denda</th>
                        <th>Nominal Denda</th>
					</tr>
				</thead>
				<tbody>
                    <?php 
                        $i = 1;
                        foreach ($data_pengembalian as $data):
                    ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $data['kode_pengemblian'] ?></td>
							<td><?php echo date("l, d-m-Y", strtotime($data['tanggal_pinjam'])) ?></td>
                            <td><?php echo $data['kode_peminjaman'] ?></td>
                            <td><?php echo $data['NIM'].' - '.$data['nama'] ?></td>
                            <td><?php echo date("l, d-m-Y", strtotime($data['tanggal_pengembalian'])) ?></td>
							<td><?php echo $data['keterangan'] ?></td>
                            <td><?php echo 'Rp.'.number_format($data['total_denda']) ?></td>
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
