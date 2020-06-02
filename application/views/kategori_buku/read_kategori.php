<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<div class="my-2"></div>

<!-- button tambah data mahasiswa -->
<a href="<?php echo site_url('kategori_buku/insert');?>" class="btn btn-success btn-icon-split">
	<span class="icon text-white-50">
		<i class="fas fa-plus-circle"></i>
	</span>
	<span class="text">Tambah</span>
</a>

<!-- Spacing class -->
<div class="my-2"></div>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Daftar Kategori</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class ="thead-dark">
					<tr>
						<th>#</th>
						<th>Kode Kategori</th>
						<th>Kategori Buku</th>
                        <th>Opsi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					 $i = 1;
					 foreach($data_kategori as $kategori): 
					?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $kategori['id_kategoribuku']; ?></td>
							<td><?php echo $kategori['kategori_buku']; ?></td>
							<td>
								<a href="<?php echo site_url('kategori_buku/update/'.$kategori['id_kategoribuku']);?>" class="btn btn-warning btn-circle">
									<i class="fas fa-edit"></i>
								</a>
	
								<a href="<?php echo site_url('kategori_buku/delete/'.$kategori['id_kategoribuku']);?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" class="btn btn-danger btn-circle">
									<i class="fas fa-trash"></i>
								</a>
								<a href="<?php echo site_url('kategori_buku/export_single/'.$kategori['id_kategoribuku']);?>" class="btn btn-primary btn-circle">
									<i class="fas fa-file-export"></i>
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
