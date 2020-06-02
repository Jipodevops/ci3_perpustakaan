<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Tambah Kategori Buku</h6>
	</div>
	<div class="card-body">
		<form method="post" action="<?php echo site_url('kategori_buku/insert_submit/');?>">
			<table class="table table-striped">
				<tr>
					<td>Kategori Buku</td>
                    <td><input type="text" placeholder="masukkan kategori" name="kategori" class="form-control" required=""></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><button type="submit" class="btn btn-success" name="submit">Simpan</button></td>
				</tr>
			</table>
		</form>
	</div>
</div>