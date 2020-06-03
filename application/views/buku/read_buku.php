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
                    <?php
                        $i = 1;

                        foreach($data_buku as $buku){
                    ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $buku['id_buku'];?></td>
                                    <td><?php echo $buku['judul'];?></td>
                                    <td><?php echo $buku['penulis'];?></td>
                                    <td><?php echo $buku['penerbit'];?></td>
                                    <td><?php echo $buku['tahun_terbit'];?></td>
                                    <td><?php echo $buku['jumlah'];?></td>
                                    <td><?php echo $buku['kategori_buku'];?></td>
                                    <td><?php echo 'Rak '.$buku['kode_rak'].' - '.$buku['kategori'];?></td>
                                    <td>
                                        <img height="50" alt="" class="zoom" src="<?php echo site_url('../upload_folder/'.$buku['foto_sampul']);?>" style="width:50px;">  
                                    </td>
                                    <td>
                                        <a href="<?php echo site_url('buku/update/'.$buku['id_buku']); ?>" class="btn btn-warning btn-circle">
                                            <i class="fas fa-edit"></i>
                                        </a>
            
                                        <a href="<?php echo site_url('buku/delete/'.$buku['id_buku']); ?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" class="btn btn-danger btn-circle">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                    <?php
                        }
                    ?>
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
		$('#dataTable').DataTable();
	});
</script>
