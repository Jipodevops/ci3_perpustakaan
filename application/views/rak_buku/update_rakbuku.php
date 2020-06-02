<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Ubah Rak Buku</h6>
	</div>
	<div class="card-body">
		<form method="post" action="<?php echo site_url('rakbuku/update_submit/'.$data_rak['kode_rak']); ?>">
			<table class="table table-striped">
				<tr>
					<td>Kategori</td>
                    <td><input type="text" value="<?php echo $data_rak['kategori'] ?>" name="kategori" class="form-control" required=""></td>
				</tr>
				<tr>
					<td>Lokasi Rak</td>
                    <td><input type="text" value="<?php echo $data_rak['lokasi'] ?>" name="lokasi_rak" class="form-control" required=""></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><button type="submit" class="btn btn-success" name="submit">Simpan Perubahan</button></td>
				</tr>
			</table>
		</form>
	</div>
</div>