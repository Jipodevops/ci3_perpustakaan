<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="card shadow mb-4" id="cardPeminjaman">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Kode Pengembalian - <?php echo $noUrut; ?></h6>
	</div>
	<div class="card-body">
		<form method="post" action="<?php echo site_url('peminjaman/insert_submit/');?>">
            <input type="hidden" value="<?php echo $noUrut; ?>" name="kd_pengembalian" id="kd_pengembalian">
			<table class="table">
                <tr>
                    <td>Kode Peminjaman</td>
                        <td>
                            <select name="kd_peminjaman" id="kd_peminjaman" class="form-control">
                                <option></option>
                                <?php foreach($data_peminjaman as $data): ?>
                                    <option value="<?php echo $data['kode_peminjaman'] ?>"><?php echo $data['kode_peminjaman'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                        <td>NIM</td>
                        <td><input type="text" readonly name="nim" id="nim"  class="form-control" required=""></td>
                </tr>
                <tr>
					<td>Tanggal Pengembalian</td>
                    <td><input type="text" readonly value="<?php echo $tglkembali; ?>" name="tgl_pengembalian" id="tgl_pengembalian" class="form-control"></td>
                    <td>Nama</td>
					<td><input type="text" readonly name="nama_mhs" id="nama_mhs" class="form-control"></td>
				</tr>
                <tr>
                    <td>Tanggal Peminjaman</td>
					<td><input type="text" readonly name="tgl_peminjaman" id="tgl_peminjaman" class="form-control"></td>
                    <td>Denda Keterlambatan</td>
					<td><input type="text" readonly id="denda" name="denda"  class="form-control" required=""></td>
                </tr>
                <tr id="dendaLainnya">
                    <td></td>
                    <td></td>
                    <td></td>
					<td>
                        <select id="denda1" name="denda1"  class="form-control">
                                    <option></option>
                                    <?php foreach ($data_denda as $data1):?>
                                        <option value="<?php echo $data1['kode_denda'];?>"><?php echo $data1['keterangan'];?></option>
                                    <?php endforeach; ?>
                        </select>
                    </td>
                </tr>
				<tr id="colSimpan">
					<td>&nbsp;</td>
					<td colspan="2"><button type="button" id="btnSimpan" class="btn btn-success">Proses Pengembalian</button></td>
                    <td><button type="button" id="btnTmbDenda" class="btn btn-warning">Denda Lainnya</button></td>
				</tr>
			</table>
		</form>
        <div id="tabel_buku"></div>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $("#dendaLainnya").hide();
        $("#kd_peminjaman").change(function(){
            var kd_peminjaman = $("#kd_peminjaman").val();
            var tgl_pengembalian = $("#tgl_pengembalian").val();
            
            $.ajax({
                url:"<?php echo site_url('pengembalian/searchKodePeminjaman') ?>",
                type:"POST",
                data:"kd_peminjaman="+kd_peminjaman,
                cache: false,
                success:function(d){
                    //console.log(d);
                    dt = d.split("|");
                    $("#tgl_peminjaman").val(dt[0]);
                    $("#nim").val(dt[1]);
                    $("#nama_mhs").val(dt[2]);

                    $("#tabel_buku").load("<?php echo site_url('pengembalian/tampilBuku') ?>", "kd_peminjaman="+kd_peminjaman);
                    
                    loadDenda();
                }
            })
        })

        $('#btnTmbDenda').click(function(){
            $("#dendaLainnya").show();
        })

        function loadDenda() {
            var kd_peminjaman = $("#kd_peminjaman").val();
            var tgl_pengembalian = $("#tgl_pengembalian").val();

            $.ajax({
                url:"<?php echo site_url('pengembalian/hitungDenda') ?>",
                type:"POST",
                data:"kd_peminjaman="+kd_peminjaman,
                cache: false,
                success:function(d){
                    if (kd_peminjaman == "") {
                        $("#denda").val(0);    
                    }else{
                        $("#denda").val(d);
                    }
                }
            })
        }

        $("#btnSimpan").click(function() {
            var kd_pengembalian  = $("#kd_pengembalian").val();
            var kd_peminjaman    = $("#kd_peminjaman").val();
            var nim              = $("#nim").val();
            var tgl_pengembalian = $("#tgl_pengembalian").val();
            var denda            = parseInt($("#denda").val(), 10);
            var denda1           = parseInt($("#denda1").val(), 10);

            if (kd_peminjaman == "") {
                alert("Kode Peminjaman harus diisi.")
            }else{
                $.ajax({
                    url:"<?php echo site_url('pengembalian/insert_submit')?>",
                    type:"POST",
                    data:"kd_pengembalian="+kd_pengembalian+"&kd_peminjaman="+kd_peminjaman+"&nim="+nim+"&tgl_pengembalian="+tgl_pengembalian+"&denda="+denda+"&denda1="+denda1,
                    cache: false,
                    success: function(b) {
                        alert("Kode Pengembalian "+kd_pengembalian+" berhasil disimpan");
                        window.location="<?php echo site_url('pengembalian'); ?>"
                    }
                })
            }
        })

    })
</script>
