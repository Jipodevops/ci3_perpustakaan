<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<div class="my-2"></div>

<!-- Spacing class -->
<div class="my-2"></div>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Detail Peminjaman - <?php echo $id; ?></h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class ="thead-dark">
					<tr>
						<th>Kode Buku</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Penerbit</th>
					</tr>
				</thead>
				<tbody>
						<?php foreach($data_detail as $data):?>
                            <tr>
                                <td><?php echo $data['id_buku']; ?></td>
                                <td><?php echo $data['judul']; ?></td>
                                <td><?php echo $data['penulis']; ?></td>
                                <td><?php echo $data['penerbit']; ?></td>
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
