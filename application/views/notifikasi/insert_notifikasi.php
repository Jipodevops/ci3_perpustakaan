<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Tambah Notifikasi</h6>
	</div>
	<div class="card-body">
		<form method="post" action="<?php echo site_url('notifikasi/insert_submit/');?>">
			<table class="table table-striped">
            <!--
				<tr>
					<td>NIM</td>
                    <td>
                        <select name="nim" id="nim" onkeyup="generate()" class="form-control">
                            <?php foreach($data_nim as $nim): ?>
                                <option value="<?php echo $nim['NIM'] ?>"><?php echo $nim['NIM'].' - '.$nim['nama'] ?> </option>
                            <?php endforeach; ?>
                        </select>
                    </td>
				</tr>
            -->
                <tr>
					<td>NIM</td>
                    <td><input type="text" name="nim" id="nim" onkeyup="generate()" class="form-control" required=""></td>
				</tr>
				<tr>
					<td>Kode Peminjaman</td>
                    <td><input type="text" disabled id="kode_peminjaman" name="kode_peminjaman" class="form-control" required=""></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td><button type="submit" class="btn btn-success" name="submit">Simpan</button></td>
				</tr>
			</table>
		</form>
	</div>
</div>

<script type="text/javascript">
    function generate(){
        var nim = $("#nim").val();
        $.ajax({
            url : "<?php site_url('notifikasi/ajax/'); ?>",
            data: "nim="+nim,
        }).success(function (data){
            var json = data,
            obj = JSON.parse(json);
            $('#kode_peminjaman').val(obj.kode_peminjaman);
        })
    }
</script>