<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Tambah Koleksi Buku</h6>
	</div>
	<div class="card-body">
		<form method="post" action="<?php echo site_url('buku/insert_submit/');?>" enctype="multipart/form-data">
			<table class="table table-striped">
				<tr>
					<td>Judul</td>
					<td><input type="text" placeholder="masukkan judul" name="judul" class="form-control" required=""></td>
                </tr>
                <tr>
					<td>Penulis</td>
					<td><input type="text" placeholder="masukkan nama penulis" name="penulis" class="form-control" required=""></td>
                </tr>
                <tr>
					<td>Penerbit</td>
					<td><input type="text" placeholder="masukkan penerbit" name="penerbit" class="form-control" required=""></td>
                </tr>
                <tr>
					<td>Tahun Terbit</td>
                    <td><input type="number" min="1900" max="2099" step="1" value="2020" name="dateTerbit" class="form-control" required=""></td>
                </tr>
                <tr>
					<td>Jumlah Buku</td>
                    <td><input type="number" placeholder="masukkan jumlah buku" name="jum_buku" class="form-control" required=""></td>
				</tr>
				<tr>
					<td>Kategori Buku</td>
					<td>
                        <select name="kat_buku" class="form-control">
                            <option>pilih kategori buku</option>
                            <?php
                                foreach($kategori as $kat){
                                    echo "
                                        <option value='$kat[id_kategoribuku]'>$kat[kategori_buku]</option>
                                    ";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
					<td>Rak Buku</td>
					<td>
                        <select name="rak_buku" class="form-control">
                            <option>pilih rak buku</option>
                            <?php
                                foreach($rak_buku as $rak){
                                    echo "
                                        <option value='$rak[kode_rak]'>$rak[kode_rak] - $rak[kategori] - $rak[lokasi]</option>
                                    ";
                                }
                            ?>
                        </select>
                    </td>
                </tr>
                <tr>
					<td>Foto Sampul</td>
                    <td><input type="file" name="foto_sampul" class="form-control-file" size="20">
                        <?php if(!empty($response)):?>
                            <?php echo $response;?>
                        <?php endif;?>
                    </td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><button type="submit" class="btn btn-success" name="submit">Simpan</button></td>
				</tr>
			</table>
        </form>
        <!--response setelah upload-->
	
	</div>
</div>