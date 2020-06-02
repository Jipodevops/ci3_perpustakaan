<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<div class="card shadow mb-4" id="cardPeminjaman">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Kode Peminjaman - <?php echo $noUrut; ?></h6>
	</div>
	<div class="card-body">
		<form method="post" action="<?php echo site_url('peminjaman/insert_submit/');?>">
            <input type="hidden" value="<?php echo $noUrut; ?>" name="kd_peminjaman" id="kd_peminjaman">
			<table class="table">
                <tr>
					<td>Tanggal Peminjaman</td>
                    <td><input type="text" readonly value="<?php echo $tglpinjam; ?>" name="tgl_peminjaman" id="tgl_peminjaman" class="form-control"></td>
                    <td>Jatuh Tempo</td>
					<td><input type="text" readonly value="<?php echo $tglkembali; ?>" name="jatuh_tempo" id="jatuh_tempo" class="form-control"></td>
				</tr>
                <tr>
                <td>NIM</td>
                    <td>
                        <select name="nim" id="nim" class="form-control">
                            <option></option>
                            <?php foreach($data_mahasiswa as $data): ?>
                                <option value="<?php echo $data['NIM'] ?>"><?php echo $data['NIM'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td>Nama</td>
					<td><input type="text" disabled id="nama"  class="form-control" required=""></td>
                </tr>
				<tr id="colSimpan">
					<td>&nbsp;</td>
					<td colspan="4"><button type="button" id="btnSimpan" class="btn btn-success">Proses</button></td>
				</tr>
			</table>
		</form>
	</div>
</div>

<div class="card shadow mb-4" id="cardBuku">
	<div class="card-body">
            
			<table class="table">
                <tr>
					<td>Kode</td>
                    <td><input type="text" readonly value="" name="kode_buku" id="kode_buku" class="form-control"></td>
                    <td>Judul</td>
					<td><input type="text" readonly value="" name="nama_buku" id="nama_buku" class="form-control"></td>
                    <td>Pengarang</td>
					<td><input type="text" readonly value="" name="pengarang" id="pengarang" class="form-control"></td>
                    <td>
                        <button id="modalBuku" class="btn btn-primary btn-circle">
							<i class="fas fa-search"></i>
                        </button>
                    </td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td colspan="6"><button type="button" id="tambah_buku" class="btn btn-success">Tambah Buku</button></td>
				</tr>
			</table>
            <div id="tabel_tmp"></div>
            <button type="button" id="btnProses" class="btn btn-success">Proses Peminjaman</button>
	</div>
</div>


<!-- Modal Cari Buku -->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5>Cari Buku</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body"><br />
                <!-- menampilkan tabel buku didalam modal -->
                <div id="tabelBuku"></div>

            </div>
            <br /><br />
            <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Kembali</button>
            <!--<button type="button" class="btn btn-primary" id="konfirmasi">Hapus</button>-->
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- End Modal Cari Buku -->


<script type="text/javascript">
    $(document).ready(function(){
        $("#cardBuku").hide();
        $("#btnProses").hide();
        //fungsi untuk mencari nim
        $("#nim").change(function() {
            var nim = $("#nim").val();

            $.ajax({
                url: "<?php echo site_url('peminjaman/search_nim'); ?>",
                type: "POST",
                data: "nim="+nim,
                cache: false,
                success:function(d){
                    $("#nama").val(d);
                }
            })
            
        })

        //fungsi button proses
        $('#btnSimpan').click(function(){
            var kd_peminjaman = $("#kd_peminjaman").val();
            var tgl_peminjaman = $("#tgl_peminjaman").val();
            var jatuh_tempo = $("#jatuh_tempo").val();
            var nim = $("#nim").val();

            if (nim == "") {
                alert("NIM wajib diisi.");
                $("#nim").focus();
                return false;
            }else{
                $.ajax({
                    url: "<?php echo site_url('peminjaman/insert_submit')?>",
                    type: "POST",
                    data: "kd_peminjaman="+kd_peminjaman+"&tgl_peminjaman="+tgl_peminjaman+"&jatuh_tempo="+jatuh_tempo+"&nim="+nim,
                    cache:false,
                    success:function(berhasil){
                        alert("Pilih Buku");

                        //menyembunyikan form transaksi jika berhasil mengisi data anggota
                        $("#colSimpan").hide();
                        $("#cardBuku").show();
                        $("#nim").prop("disabled", true);
                        $("#cardBuku").show();

                    }
                })
            }
        })

        $("#modalBuku").click(function(){
            $("#myModal2").modal("show");

            $.ajax({
                url: "<?php echo site_url("peminjaman/cari_buku"); ?>",
                type: "POST",
                cache: false,
                success : function(d){
                    $("#tabelBuku").html(d);
                }
            })
        })

        //memindahkan data dari tabel modal ke form
        $('body').on('click', '.tambah', function(){
            var kode_buku = $(this).attr("kode");
            var judul     = $(this).attr("judul");
            var pengarang = $(this).attr("pengarang");
            
            $("#kode_buku").val(kode_buku);
            $("#nama_buku").val(judul);
            $("#pengarang").val(pengarang);

            $("#myModal2").modal("hide");
            //console.log(kode_buku);
        
        })

        function loadData(){
            $("#tabel_tmp").load("<?php echo site_url('peminjaman/read_tmp') ?>");
        }

        function cleanData(){
            $("#kode_buku").val("");
            $("#nama_buku").val("");
            $("#pengarang").val("");
        }

        $("#tambah_buku").click(function(){
            var nim = $("#nim").val();

            var kode_buku = $("#kode_buku").val();
            var judul = $("#nama_buku").val();
            var pengarang = $("#pengarang").val();

            var jumlah_buku = parseInt($("#jumlah_buku").val(), 10);

            if(nim == ""){
                alert("NIM harus diisi.");
                return false;
            }else if (kode_buku == "") {
                alert("Kode Buku masih kosong.");
                return false;
            }else if(jumlah_buku >= 4){
                alert("Anda sudah mencapai batas peminjaman buku");
                return false;
            }else{
                $.ajax({
                    url:"<?php echo site_url('peminjaman/insert_tmp');?>",
                    type:"POST",
                    data:"kode_buku="+kode_buku+"&judul="+judul+"&pengarang="+pengarang,
                    cache:false,
                    success:function(hasil){
                        loadData();
                        cleanData();
                        $("#btnProses").show();
                        //console.log(hasil);
                    }
                })
            }
        })

        $('body').on('click', '.hapus', function(){
            //atribut kode yang dari readtmp_peminjaman
            var kode_buku = $(this).attr('kode');
            $.ajax({
                url:"<?php echo site_url('peminjaman/delete_tmp');?>",
                type:"POST",
                data:"kode_buku="+kode_buku,
                cache:false,
                success:function(hasil){
                    // alert(hasil);
                    loadData();
                }
            })
        })

        $("#btnProses").click(function(){
            var kd_peminjaman = $("#kd_peminjaman").val();

            if(kd_peminjaman == ""){
                alert("Kode Peminjaman tidak boleh kosong");
                return false;
            }else{
                $.ajax({
                    url:"<?php echo site_url('peminjaman/insert_transaksi'); ?>",
                    type: "POST",
                    data: "kd_peminjaman="+kd_peminjaman,
                    cache:false,
                    success: function(b){
                        window.location="<?php echo site_url('peminjaman'); ?>"
                    }
                })
            }
        })

    })
</script>