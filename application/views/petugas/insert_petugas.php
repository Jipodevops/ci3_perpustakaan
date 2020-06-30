<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Tambah Petugas</h6>
	</div>
	<div class="card-body">
		<form method="post" action="<?php echo site_url('petugas/insert_submit/');?>">
			<table class="table table-striped">
				<tr>
					<td>Nama</td>
                    <td><input type="text" placeholder="masukkan nama" name="nama" class="form-control" required=""></td>
				</tr>
                <tr>
					<td>Jenis Kelamin</td>
					<td>
                        <select name="jenkel" class="form-control">
                            <option>pilih jenis kelamin</option>
                            <option value="Laki - laki">Laki - laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </td>
				</tr>
                <tr>
					<td>Alamat</td>
					<td>
                        <textarea name="alamat" class="form-control" cols="30" rows="5"></textarea>
                    </td>
				</tr>
                <tr>
					<td>Nomor HP</td>
					<td><input type="text" placeholder="masukkan nomor hp" name="no_hp" class="form-control" required=""></td>
				</tr>
				<tr>
					<td>Username</td>
					<td><input type="text" name="username" class="form-control" required=""></td>
                    </td>
				</tr>
                <tr>
					<td>Password</td>
					<td><input type="password" name="psw" class="form-control" required=""></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><button type="submit" class="btn btn-success" name="submit">Simpan</button></td>
				</tr>
			</table>
		</form>
	</div>
</div>