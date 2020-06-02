<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Ubah Kategori Denda</h6>
	</div>
	<div class="card-body">
		<form method="post" action="<?php echo site_url('denda/update_submit/'.$data_denda['kode_denda']);?>">
			<table class="table table-striped">
				<tr>
					<td>Keterangan</td>
                    <td><input type="text" value="<?php echo $data_denda['keterangan'] ?>" name="keterangan" class="form-control" required=""></td>
				</tr>
                <tr>
					<td>Jumlah Denda</td>
                    <td><input type="number" value="<?php echo $data_denda['jumlah_denda'] ?>" name="jum_denda" class="form-control" required=""></td>
                    </td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><button type="submit" class="btn btn-success" name="submit">Simpan Perubahan</button></td>
				</tr>
			</table>
		</form>
	</div>
</div>