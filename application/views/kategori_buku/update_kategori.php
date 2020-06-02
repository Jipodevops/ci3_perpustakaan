<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Ubah Rak Buku</h6>
	</div>
	<div class="card-body">
		<form method="post" action="<?php echo site_url('kategori_buku/update_submit/'.$data_kategori['id_kategoribuku']);?>">
        <table class="table table-striped">
				<tr>
					<td>Kategori Buku</td>
                    <td><input type="text" value="<?php echo $data_kategori['kategori_buku'] ?>" name="kategori" class="form-control" required=""></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><button type="submit" class="btn btn-success" name="submit">Simpan Perubahan</button>
                    <button type="back" class="btn btn-danger">Kembali</button></td>
				</tr>
			</table>
		</form>
	</div>
</div>