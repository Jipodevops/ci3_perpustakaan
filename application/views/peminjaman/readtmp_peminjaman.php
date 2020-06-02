<!-- CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <td>ID Buku</td>
            <td>Judul Buku</td>
            <td>Penulis</td>
            <td></td>
        </tr>
    </thead>
    <?php foreach($data_tmp as $tmp):?>
    <tr>
        <td><?php echo $tmp['id_buku'];?></td>
        <td><?php echo $tmp['judul'];?></td>
        <td><?php echo $tmp['pengarang'];?></td>
        <td><a href="#" class="hapus" kode="<?php echo $tmp['id_buku'];?>"><i class="fas fa-trash"></i></a></td>
    </tr>
    <?php endforeach;?>
    <tr>
        <td colspan="2">Total Buku</td>
        <td colspan="2"><input type="text" id="jumlah_buku" readonly="readonly" value="<?php echo $count_tmp;?>" class="form-control"></td>
    </tr>
</table>