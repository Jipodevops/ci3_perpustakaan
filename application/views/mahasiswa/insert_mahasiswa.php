<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Tambah Mahasiswa</h6>
	</div>
	<div class="card-body">
		<form method="post" action="<?php echo site_url('mahasiswa/insert_submit/');?>">
			<table class="table table-striped">
				<tr>
					<td>NIM</td>
                    <td><input type="text" placeholder="masukkan nim" name="nim" class="form-control" required=""></td>
				</tr>
				<tr>
					<td>Nama</td>
					<td><input type="text" placeholder="masukkan nama" name="nama" class="form-control" required=""></td>
				</tr>
				<tr>
					<td>Jenis Kelamin</td>
					<td>
                        <select name="jenkel" class="form-control select">
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
					<td>Agama</td>
					<td>
                        <select name="agama" class="form-control">
                            <option>pilih agama</option>
                            <option value="Islam">Islam</option>
                            <option value="Kristen">Kristen</option>
                            <option value="Katholik">Katholik</option>
                            <option value="Buddha">Buddha</option>
                            <option value="Hindu">Hindu</option>
                            <option value="Kong Hu Cu">Kong Hu Cu</option>
                        </select>
                    </td>
				</tr>
                <tr>
					<td>Status Mahasiswa</td>
					<td>
                        <select name="status_mhs" class="form-control">
                            <option>pilih status mahasiswa</option>
                            <option value="Aktif">Aktif</option>
                            <option value="NonAktif">Non-Aktif</option>
                        </select>
                    </td>
				</tr>
                <tr>
					<td>Program Studi</td>
					<td>
                        <select name="prodi" class="form-control">
							<option>pilih program studi</option>
							<?php foreach($data_prodi as $prodi): ?>
								<option value="<?php echo $prodi['kode_prodi'] ?>"><?php echo $prodi['nama_fakultas'] ." - ". $prodi['nama_prodi'] ?></option>
							<?php endforeach ?>
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