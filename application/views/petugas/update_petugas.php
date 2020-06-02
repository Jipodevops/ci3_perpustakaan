<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Ubah Petugas</h6>
	</div>
	<div class="card-body">
		<form method="post" action="<?php echo site_url('petugas/update_submit/'.$data_petugas['id_petugas']);?>">
			<table class="table table-striped">
				<tr>
					<td>Nama</td>
                    <td><input type="text" value="<?php echo $data_petugas['nama']; ?>" name="nama" class="form-control" required=""></td>
				</tr>
                <tr>
					<td>Jenis Kelamin</td>
					<td>
                        <select name="jenkel" class="form-control">
                            <option value="<?php echo $data_petugas['jenis_kelamin'];?>" selected><?php echo $data_petugas['jenis_kelamin'];?></option>
                            <?php if ($data_petugas['jenis_kelamin'] == 'Laki - laki') { ?>
                                    <option value="Perempuan">Perempuan</option>
                                <?php }else{ ?>
                                     <option value="Laki - laki">Laki - laki</option>
                                <?php } ?>
                        </select>
                    </td>
				</tr>
                <tr>
					<td>Alamat</td>
					<td>
                        <textarea name="alamat" class="form-control" cols="30" rows="5"><?php echo $data_petugas['alamat']; ?></textarea>
                    </td>
				</tr>
                <tr>
					<td>Nomor HP</td>
					<td><input type="text" value="<?php echo $data_petugas['no_telepon']; ?>" name="no_hp" class="form-control" required=""></td>
				</tr>
				<tr>
					<td>Username</td>
					<td><input type="text" name="username" value="<?php echo $data_petugas['username']; ?>" class="form-control" required=""></td>
                    </td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><button type="submit" class="btn btn-success" onclick="return confirm('Data akan diubah ?')" name="submit">Simpan Perubahan</button></td>
				</tr>
			</table>
		</form>
	</div>
</div>