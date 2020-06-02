<!-- CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css"/>

<!-- Javascript -->
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<div class="table-responsive">
    <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead class ="thead-dark">
            <tr>
                <td>Kode Buku</td>
                <td>Judul Buku</td>
                <td>Pengarang</td>
                <td></td>
            </tr>
        </thead>
        <?php foreach($data_buku as $data):?>
        <tr>
            <td><?php echo $data['id_buku'];?></td>
            <td><?php echo $data['judul'];?></td>
            <td><?php echo $data['penulis'];?></td>
            <td><a href="#" class="tambah" 
                kode="<?php echo $data['id_buku'];?>"
                judul="<?php echo $data['judul'];?>"
                pengarang="<?php echo $data['penulis']?>"><i class="fas fa-plus-circle"></i></a></td>
        </tr>
        <?php endforeach;?>
    </table>
</div>

<script>
	$(document).ready(function() {
		$('#dataTable').DataTable();
	});
</script>
