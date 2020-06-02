<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Tambah Fakultas</h6>
	</div>
	<div class="card-body">
		<form method="post" action="<?php echo site_url('fakultas/insert_update/'.$single_row['kode_fakultas']);?>">
			<table class="table table-striped">
				<tr>
					<td>Nama Fakultas</td>
					<td><input type="text" value="<?php echo $single_row['nama_fakultas'] ?>" name="nama fakultas" class="form-control" required=""></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><button type="submit" class="btn btn-success" name="submit">Simpan Perubahan</button></td>
				</tr>
			</table>
		</form>
	</div>
</div>