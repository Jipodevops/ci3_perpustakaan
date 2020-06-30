<?php defined('BASEPATH') OR exit('No direct script access allowed');?>


<div class="my-2"></div>

<!-- button tambah data mahasiswa -->
<a href="<?php echo site_url('denda/insert');?>" class="btn btn-success btn-icon-split">
	<span class="icon text-white-50">
		<i class="fas fa-plus-circle"></i>
	</span>
	<span class="text">Tambah</span>
</a>

<!-- Spacing class -->
<div class="my-2"></div>
<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Daftar Denda</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead class ="thead-dark">
					<tr>
						<th>#</th>
						<th>Kode Denda</th>
						<th>Keterangan</th>
						<th>Jumlah Denda</th>
                        <th>Opsi</th>
					</tr>
				</thead>
				<tbody>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-xl-12 col-lg-12">
		<div class="card shadow mb-4">
			<!-- Card Header - Dropdown -->
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Grafik Denda</h6>
			</div>
			<!-- Card Body -->
			<div class="card-body">
				<div id="pieDenda"></div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(document).ready(function() {
		table = $('#dataTable').DataTable({
			"processing" : true,
			"serverSide" : true,
			"order" : [],
			"ajax" :{
				"url" : "<?php echo site_url('denda/datatables') ?>",
				"type" : "POST"
			},
			"columnDefs" : [
				{
					"targets" : [0],
					"orderable" : false
				},
			],
		});
	});

	$(document).ready(function() {
		$('#dataTable').DataTable();
	

	Highcharts.chart('pieDenda', {
	    chart: {
	        plotBackgroundColor: null,
	        plotBorderWidth: null,
	        plotShadow: false,
	        type: 'pie'
	    },
	    title: {
	        text: 'Jumlah Denda berdasarkan Pengembalian'
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
	        name: 'Jumlah',
	        colorByPoint: true,

	        //format data penduduk kota
	        data: [
	        		<?php foreach($chart as $data):?>
	        		{
			            name: '<?php echo $data['keterangan'];?>',
			            y: <?php echo $data['denda'];?>
			        },
              <?php endforeach?>

			   	]
	    }]
	});
});
</script>
