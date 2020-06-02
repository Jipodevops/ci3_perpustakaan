<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title> <?php echo $judul;;?></title>

  <!-- css yang digunakan theme -->
  <link href="<?php echo base_url('assets/vendor/fontawesome-free/css/all.min.css');?>" rel="stylesheet" type="text/css"> 
  <link href="<?php echo base_url('assets/css/sb-admin-2.min.css');?>" rel="stylesheet">

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url(); ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url(); ?>assets/js/sb-admin-2.min.js"></script>

</head>

<body class="bg-gradient-primary">

  <!-- container -->
  <div class="container">

<div class="row justify-content-center">

      <div class="col-xl-11 col-lg-12 col-md-9">

        <div class="card o-hidden border-0 shadow-lg my-5">
          <div class="card-body p-2">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg-6">
                 <div class="p-5">
                 <div class="card mb-3">
                    <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-danger text-center">WELCOME!!!</h6>
                    </div>
                    <div class="card-body">
                      <b> Developed by</b><br>
                      <ol>
                        <li><b>Eka Pramudianzah</b>  - 41518010064</li>
                        <li><b>Ayu Wulandari</b>     - 41518010117</li>
                        <li><b>Jodikal Pomalingo</b> - 41518010033</li>
                      <ol>
                    </div>
                  </div>
                  </div>
                </div>
              <div class="col-lg-6">
                <div class="p-5">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login Petugas</h1>
                  </div>
                        
                  <?php 
                    echo validation_errors('<div class="alert alert-danger text-center">', '</div>');
                  ?>

                          <form method="post" action="<?php echo site_url('login');?>" class="user">
                                <div class="form-group">
                                    <input type="text" name="username" class="form-control form-control-user" placeholder="Username" value="<?php echo set_value('username'); ?>">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" class="form-control form-control-user" placeholder="Password" value="<?php echo set_value('password'); ?>">
                                </div>
                                
                                <input type="submit" name="submit" value="Masuk" class="btn btn-primary btn-user btn-block">
                          </form>
                               
                </div>
                <!-- form -->

              </div>
              <!--inner col-->

            </div>
            <!-- inner row -->

          </div>
          <!-- card body -->
          
        </div>
        <!-- card -->

      </div>
      <!-- outer col-->

    </div>
    <!-- outer row -->

  </div>
  <!-- container -->

</body>
</html>
