<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<div class="my-2"></div>

<!-- button tambah data mahasiswa -->
<a href="<?php echo site_url('mahasiswa/insert');?>" class="btn btn-success btn-icon-split">
	<span class="icon text-white-50">
		<i class="fas fa-plus-circle"></i>
	</span>
	<span class="text">Buat Data</span>
</a>

<a href="<?php echo site_url('mahasiswa/export_all');?>" class="btn btn-primary btn-icon-split">
	<span class="icon text-white-50">
		<i class="fas fa-download"></i>
	</span>
	<span class="text">Cetak/Ekspor</span>
</a>


<!-- Spacing class -->
<div class="my-2"></div>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Daftar Mahasiswa</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class ="thead-dark">
					<tr>
						<th>#</th>
						<th>NIM</th>
						<th>Nama</th>
						<th>Jenis Kelamin</th>
						<th>Alamat</th>
						<th>Nomor HP</th>
                        <th>Agama</th>
                        <th>Program Studi</th>
						<th>Status</th>
						<th>Opsi</th>
					</tr>
				</thead>
				<tbody>
					<?php
					 $i = 1;
					 foreach($data_mahasiswa as $mhs): 
					?>
						<tr>
							<td><?php echo $i++; ?></td>
							<td><?php echo $mhs['NIM']; ?></td>
							<td><?php echo $mhs['nama']; ?></td>
							<td><?php echo $mhs['jenis_kelamin']; ?></td>
							<td><?php echo $mhs['alamat']; ?></td>
							<td><?php echo $mhs['no_telepon']; ?></td>
							<td><?php echo $mhs['agama']; ?></td>
							<td><?php echo $mhs['nama_prodi']; ?></td>
							<td><?php echo $mhs['status_mahasiswa']; ?></td>
							<td>
								<a href="<?php echo site_url('mahasiswa/update/'.$mhs['NIM']);?>" class="btn btn-warning btn-circle">
									<i class="fas fa-edit"></i>
								</a>
	
								<a href="<?php echo site_url('mahasiswa/delete/'.$mhs['NIM']);?>" onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" class="btn btn-danger btn-circle">
									<i class="fas fa-trash"></i>
								</a>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-6 col-lg-8">
		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Grafik Program Studi</h6>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<div id="pieFakultas"></div>
			</div>
		</div>
	</div>
	<div class="col-xl-6 col-lg-8">
		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Grafik Fakultas</h6>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<div id="grafikProdi"></div>
			</div>
		</div>
	</div>
</div>



<script>
	$(document).ready(function() {
		$('#dataTable').DataTable();

		Highcharts.chart('pieFakultas', {
			chart: {
				plotBackgroundColor: null,
				plotBorderWidth: null,
				plotShadow: false,
				type: 'pie'
			},
			title: {
				text: 'Jumlah Mahasiswa berdasarkan Fakultas'
			},
			tooltip: {
				pointFormat: '{series.name}: <b>{point.y}</b>'
			},
			accessibility: {
				point: {
					valueSuffix: '%'
				}
			},
			plotOptions: {
				pie: {
					allowPointSelect: true,
					cursor: 'pointer',
					dataLabels: {
						enabled: false
					},
					showInLegend: true
				}
			},
			series: [{
				name: 'Mahasiswa',
				colorByPoint: true,

				//format data penduduk kota
				data: [
						<?php foreach($grafikFakultas as $data):?>
						{
							name: '<?php echo $data['nama_fakultas'];?>',
							y: <?php echo $data['countNIM'];?>
						},
				<?php endforeach?>

					]
			}]
		});
		Highcharts.chart('grafikProdi', {
			chart: {
				type: 'column'
			},
			title: {
				text: 'Jumlah Mahasiswa Per Program Studi'
			},
			xAxis: {
				categories: [
					'Program Studi'
				],
				crosshair: true
			},
			yAxis: {
				min: 0,
				title: {
					text: 'Mahasiswa'
				}
			},
			tooltip: {
				headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
				pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
					'<td style="padding:0"><b>{point.y}</b></td></tr>',
				footerFormat: '</table>',
				shared: true,
				useHTML: true
			},
			plotOptions: {
				column: {
					pointPadding: 0.2,
					borderWidth: 0
				}
			},
			series: [
					
					<?php foreach($grafikProdi as $data):?>
							{
								name  : '<?php echo $data['nama_prodi'];?>',
								data  : [<?php echo $data['countNIM'];?>]
							},
							<?php endforeach?>
			]
		});
	});
	
</script>
