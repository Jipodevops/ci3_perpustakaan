<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Ubah Mahasiswa</h6>
	</div>
	<div class="card-body">
		<form method="post" action="<?php echo site_url('mahasiswa/update_submit/'.$data_mahasiswa['NIM']);?>">
			<table class="table table-striped">
				<tr>
					<td>NIM</td>
                    <td><input type="text" value="<?php echo $data_mahasiswa['NIM']; ?>" disabled name="nim" class="form-control"></td>
				</tr>
				<tr>
					<td>Nama</td>
					<td><input type="text" value="<?php echo $data_mahasiswa['nama']; ?>" name="nama" class="form-control" required=""></td>
				</tr>
				<tr>
					<td>Jenis Kelamin</td>
					<td>
                        <select name="jenkel" class="form-control">
                            <option value="<?php echo $data_mahasiswa['jenis_kelamin'];?>" selected><?php echo $data_mahasiswa['jenis_kelamin'];?></option>
                            <?php if ($data_mahasiswa['jenis_kelamin'] == 'Laki - laki') { ?>
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
                        <textarea name="alamat" class="form-control" cols="30" rows="5"><?php echo $data_mahasiswa['alamat']; ?></textarea>
                    </td>
				</tr>
                <tr>
					<td>Nomor HP</td>
					<td><input type="text" value="<?php echo $data_mahasiswa['no_telepon']; ?>" name="no_hp" class="form-control" required=""></td>
				</tr>
                <tr>
					<td>Agama</td>
					<td>
                        <select name="agama" class="form-control">
                        <option value="<?php echo $data_mahasiswa['agama'];?>" selected><?php echo $data_mahasiswa['agama'];?></option>
                        <?php
                            if($data_mahasiswa['agama'] == 'Islam'){
                                echo '
                                <option value="Kristen">Kristen</option>
                                <option value="Katholik">Katholik</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Kong Hu Cu">Kong Hu Cu</option>
                                ';
                            }else if($data_mahasiswa['agama'] == 'Kristen'){
                                echo '
                                <option value="Islam">Islam</option>
                                <option value="Katholik">Katholik</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Kong Hu Cu">Kong Hu Cu</option>
                                ';
                            }else if($data_mahasiswa['agama'] == 'Katholik'){
                                echo '
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Kong Hu Cu">Kong Hu Cu</option>
                                ';
                            }else if($data_mahasiswa['agama'] == 'Buddha'){
                                echo '
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katholik">Katholik</option>
                                <option value="Hindu">Hindu</option>
                                <option value="Kong Hu Cu">Kong Hu Cu</option>
                                ';
                            }else if($data_mahasiswa['agama'] == 'Hindu'){
                                echo '
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katholik">Katholik</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Kong Hu Cu">Kong Hu Cu</option>
                                ';
                            }else if($data_mahasiswa['agama'] == 'Kong Hu Cu'){
                                echo '
                                <option value="Islam">Islam</option>
                                <option value="Kristen">Kristen</option>
                                <option value="Katholik">Katholik</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Hindu">Hindu</option>
                                ';
                            }
                        ?>
                            
                        </select>
                    </td>
				</tr>
                <tr>
					<td>Status Mahasiswa</td>
					<td>
                        <select name="status_mhs" class="form-control">
                        <option value="<?php echo $data_mahasiswa['status_mahasiswa'];?>" selected><?php echo $data_mahasiswa['status_mahasiswa'];?></option>
                            <?php if ($data_mahasiswa['status_mahasiswa'] == 'Aktif') { ?>
                                    <option value="NonAktif">Non Aktif</option>
                                <?php }else{ ?>
                                     <option value="Aktif">Aktif</option>
                                <?php } ?>
                        </select>
                    </td>
				</tr>
                <tr>
					<td>Program Studi</td>
					<td>
                        <select name="prodi" class="form-control">
                            <?php foreach($data_prodi as $prodi): ?>
                                <?php if($prodi['kode_prodi'] == $data_mahasiswa['kode_prodi']):?>
                                    <option value="<?php echo $prodi['kode_prodi'] ?>" selected><?php echo $prodi['nama_fakultas'] ." - ". $prodi['nama_prodi'] ?></option>
                                <?php else:?>
						            <option value="<?php echo $prodi['kode_prodi'];?>"><?php echo $prodi['nama_fakultas'] ." - ". $prodi['nama_prodi'];?></option>
                                <?php endif; ?>
							<?php endforeach ?>
                        </select>
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