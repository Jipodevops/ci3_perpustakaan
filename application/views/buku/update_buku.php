<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Tambah Koleksi Buku</h6>
	</div>
	<div class="card-body">
		<form method="post" action="<?php echo site_url('buku/update_submit/'.$data_buku['id_buku']);?>" enctype="multipart/form-data">
			<table class="table table-striped">
            <input type="hidden" id="old" name="old" value="<?php echo $data_buku['foto_sampul']; ?>">
				<tr>
					<td>Judul</td>
					<td><input type="text" value="<?php echo $data_buku['judul'] ?>" name="judul" class="form-control" required=""></td>
                </tr>
                <tr>
					<td>Penulis</td>
					<td><input type="text" value="<?php echo $data_buku['penulis'] ?>" name="penulis" class="form-control" required=""></td>
                </tr>
                <tr>
					<td>Penerbit</td>
					<td><input type="text" value="<?php echo $data_buku['penerbit'] ?>" name="penerbit" class="form-control" required=""></td>
                </tr>
                <tr>
					<td>Tahun Terbit</td>
                    <td><input type="number" min="1900" max="2099" step="1" value="<?php echo $data_buku['tahun_terbit'] ?>" name="dateTerbit" class="form-control" required=""></td>
                </tr>
                <tr>
					<td>Jumlah Buku</td>
                    <td><input type="number" value="<?php echo $data_buku['jumlah'] ?>" name="jum_buku" class="form-control" required=""></td>
				</tr>
				<tr>
					<td>Kategori Buku</td>
					<td>
                        <select name="kat_buku" class="form-control">
                            <?php
                                foreach($kategori as $kat){        
                                    if ($data_buku['id_kategoribuku'] == $kat['id_kategoribuku']) {
                            ?>
                                        <option value="<?php echo $kat['id_kategoribuku']?>" selected><?php echo $kat['kategori_buku']?></option>
                            <?php       }else{ ?>
                                        <option value="<?php echo $kat['id_kategoribuku']?>"><?php echo $kat['kategori_buku']?></option>
                            <?php
                                    }     
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
					<td>Rak Buku</td>
					<td>
                        <select name="rak_buku" class="form-control">
                            <?php
                                foreach($rak_buku as $rak){
                                    if ($data_buku['kode_rak'] == $rak['kode_rak']) {
                            ?>
                                        <option value="<?php echo $rak['kode_rak']?>" selected><?php echo $rak['kode_rak'].' - '.$rak['kategori'].' - '.$rak['lokasi']?></option>
                            <?php   }else{ ?>
                                        <option value="<?php echo $rak['kode_rak']?>"><?php echo $rak['kode_rak'].' - '.$rak['kategori'].' - '.$rak['lokasi']?></option>
                            <?php
                                    }     
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
					<td></td>
                    <td>
                        <img height="50" alt="" class="zoom" src="<?php echo site_url('../upload_folder/'.$data_buku['foto_sampul']);?>" style="width:50px;">
                    </td>
				</tr>
                <tr>
					<td>Foto Sampul</td>
                    <td>
                       <input type="file" name="foto_sampul" class="form-control-file" size="20">
                        <?php if(!empty($response)):?>
                            <?php echo $response;?>
                        <?php endif;?>
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