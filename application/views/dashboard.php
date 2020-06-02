
<!-- End of Main Content -->
          <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Total Peminjaman</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jumPeminjaman; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book-open fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Koleksi Buku</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jumBuku; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Anggota/Mahasiswa</div>
                      <div class="row no-gutters align-items-center">
                        <div class="col-auto">
                          <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $jumMahasiswa; ?></div>
                        </div>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Belum Dikembalikan</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jumBelDikembalikan; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-12 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Koleksi Buku</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div id="grafikKoleksi"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <!-- Area Chart -->
            <div class="col-xl-6 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Grafik Batang</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div id="grafikBukuMinat"></div>
                </div>
              </div>
            </div>
            <!-- Area Chart -->
            <div class="col-xl-6 col-lg-12">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Grafik Lingkaran</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div id="piePeminjaman"></div>
                </div>
              </div>
            </div>
          </div>

<script type="text/javascript">
    Highcharts.chart('grafikKoleksi', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Koleksi Buku Per Kategori'
        },
        xAxis: {
            categories: [
                'Kategori Buku'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah (buku)'
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

                <?php foreach($grafikBuku as $data):?>
                        {
                            name  : '<?php echo $data['kategori_buku'];?>',
                            data  : [<?php echo $data['countBok'];?>]
                        },
                        <?php endforeach?>
        ]
    });
    //Grafik untuk buku yang diminati
    Highcharts.chart('grafikBukuMinat', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Buku yang diminati'
        },
        xAxis: {
            categories: [
                'Nama Buku'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Jumlah (buku)'
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

                <?php foreach($grafikPerBook as $data):?>
                        {
                            name  : '<?php echo $data['judul'];?>',
                            data  : [<?php echo $data['countBook'];?>]
                        },
                        <?php endforeach?>
        ]
    });

    //
    Highcharts.chart('piePeminjaman', {
	    chart: {
	        plotBackgroundColor: null,
	        plotBorderWidth: null,
	        plotShadow: false,
	        type: 'pie'
	    },
	    title: {
	        text: 'Peminjaman Buku Per Program Studi'
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
	        		<?php foreach($grafikPinjamPerProdi as $data):?>
	        		{
			            name: '<?php echo $data['nama_prodi'];?>',
			            y: <?php echo $data['countPeminjaman'];?>
			        },
              <?php endforeach?>

			   	]
	    }]
	});
</script>

