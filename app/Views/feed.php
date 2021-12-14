<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>INSTA SOSMED | FEED</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo base_url()?>/template/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url()?>/template/dist/css/adminlte.min.css">
</head>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <a href="../../index3.html" class="navbar-brand">
        <img src="<?php echo base_url()?>/template/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Insta SOSMED</span>
      </a>

      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <!-- <a href="index3.html" class="nav-link">Home</a> -->
          </li>
          <li class="nav-item">
            <!-- <a href="#" class="nav-link">Contact</a> -->
          </li>
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            Selamat Datang, <?php echo session('first_name')." ".session('last_name')?>
          </a>
          <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
            <div class="dropdown-divider"></div>
            <a href="<?php echo base_url('logout')?>" class="dropdown-item dropdown-footer">Logout</a>
          </div>
        </li>
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h4 class="card-title">Write Something</h4>
                </div>
                <form action="<?php echo base_url('feed')?>" method="post" enctype="multipart/form-data">
                  <div class="card-body">
                      <textarea name="post" class="form-control" id="" cols="30" rows="5"></textarea>
                      <br>
                      <label for="">Gambar (jika diperlukan)</label>
                      <input type="file" name="gambar" id="gambar" class="form-control">
                  </div>
                  <div class="card-footer text-right">
                      <button type="submit" class="btn btn-lg btn-primary">Post</button>
                  </div>
                </form>
            </div>

          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-12">
            <?php foreach ($feed as $key => $value) { ?>
            <div class="card card-primary card-outline">
              <div class="card-header">
                <span class="username"><a href="#"><?php echo $value['first_name']." ".$value['last_name']?></a></span>
                <br>
                <span class="description">Posted On / <?php echo $value['created_at']?></span>
              </div>
              <div class="card-body">
                <img class="img-thumbnail pad" src="<?php echo base_url()?>/post-upload/<?php echo $value['image']?>" alt="Photo">

                <p><?php echo $value['post']?></p>
                <!-- <button type="button" class="btn btn-default btn-sm"><i class="fas fa-share"></i> Share</button> -->
                <?php if (in_array($value['id'],$post_id)) { ?>
                <form action="<?php echo base_url('unlike')?>" method="post">
                  <input type="hidden" name="post_id" value="<?php echo $value['id']?>">
                  <button type="submit" class="btn btn-danger btn-sm"><i class="far fa-thumbs-down"></i> Unlike</button>
                </form>
                <?php } else { ?>
                <form action="<?php echo base_url('likes')?>" method="post">
                  <input type="hidden" name="post_id" value="<?php echo $value['id']?>">
                  <button type="submit" class="btn btn-default btn-sm"><i class="far fa-thumbs-up"></i> Like</button>
                </form>
                <?php } ?>
                <span class="float-right text-muted">127 likes - 3 comments</span>
              </div>
              <div class="card-footer card-comments">
                <div class="card-comment">
                  <!-- User image -->
                  <!-- <img class="img-circle img-sm" src="<?php echo base_url()?>/template/dist/img/user3-128x128.jpg" alt="User Image"> -->

                  <div class="comment-text">
                    <span class="username">
                      Maria Gonzales
                      <span class="text-muted float-right">8:03 PM Today</span>
                    </span><!-- /.username -->
                    It is a long established fact that a reader will be distracted
                    by the readable content of a page when looking at its layout.
                  </div>
                  <!-- /.comment-text -->
                </div>
                <!-- /.card-comment -->
                <div class="card-comment">
                  <!-- User image -->
                  <!-- <img class="img-circle img-sm" src="<?php echo base_url()?>/template/dist/img/user4-128x128.jpg" alt="User Image"> -->

                  <div class="comment-text">
                    <span class="username">
                      Luna Stark
                      <span class="text-muted float-right">8:03 PM Today</span>
                    </span><!-- /.username -->
                    It is a long established fact that a reader will be distracted
                    by the readable content of a page when looking at its layout.
                  </div>
                  <!-- /.comment-text -->
                </div>
                <!-- /.card-comment -->
              </div>
              <!-- /.card-footer -->
              <div class="card-footer">
                <form action="#" method="post">
                  <!-- <img class="img-fluid img-circle img-sm" src="../dist/img/user4-128x128.jpg" alt="Alt Text"> -->
                  <!-- .img-push is used to add margin to elements next to floating images -->
                  <div class="img-push">
                    <input type="text" class="form-control form-control-sm" placeholder="Press enter to post comment">
                  </div>
                </form>
              </div>
              <!-- /.card-footer -->
            </div>
            <?php } ?>
          </div>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo base_url()?>/template/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url()?>/template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>/template/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()?>/template/dist/js/demo.js"></script>
</body>
</html>
