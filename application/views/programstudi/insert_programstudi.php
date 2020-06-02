<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Tambah Program Studi</h6>
	</div>
	<div class="card-body">
		<form method="post" action="<?php echo site_url('programstudi/insert_submit/');?>">
			<table class="table table-striped">
				<tr>
					<td>Nama Prodi</td>
					<td><input type="text" placeholder="masukkan nama prodi" name="nama_prodi" class="form-control" required=""></td>
				</tr>
                <tr>
					<td>Kode Fakultas</td>
					<td>
						<select name="kode_fakultas" class="form-control">
							<option>Pilih kode fakultas</option>
								<?php foreach($data_fakultas as $fakultas):?>
									<option value="<?php echo $fakultas['kode_fakultas'];?>">
										<?php echo $fakultas['kode_fakultas'].' - '.$fakultas['nama_fakultas'];?> 
									</option>
								<?php endforeach;?>
						</select>
					</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><button type="submit" class="btn btn-success" name="submit">Simpan</button></td>
				</tr>
			</table>
		</form>
	</div>
</div>