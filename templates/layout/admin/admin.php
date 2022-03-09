<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= env('APP_NAME') ?></title>

  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Font Awesome -->
  <?= $this->Html->css('plugins/fontawesome-free/css/all.min'); ?>
  <!-- Tempusdominus Bootstrap 4 -->
  <?= $this->Html->css('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min'); ?>
  <!-- iCheck -->
  <?= $this->Html->css('plugins/icheck-bootstrap/icheck-bootstrap.min'); ?>
  <!-- Theme style -->
  <?= $this->Html->css('plugins/adminlte.min'); ?>
  <!-- overlayScrollbars -->
  <?= $this->Html->css('plugins/overlayScrollbars/css/OverlayScrollbars.min'); ?>
  <!-- Daterange picker -->
  <?= $this->Html->css('plugins/daterangepicker/daterangepicker'); ?>
  <!-- Main Style -->
  <?= $this->Html->css('common/main') ?>
  <!-- View CSS -->
  <?= $this->fetch('css') ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto p-2">
      <span class=""><?= h($user->name??$user->email) ?></span>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="<?= $this->Url->build(['prefix' => 'Admin', 'controller' => 'Login', 'action' => 'logout']) ?>" class="ml-2">Logout</a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= $topRoute ?>" class="brand-link">
      <span class="brand-text font-weight-light"><?= env('APP_NAME') ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <?php foreach($pagesName as $label => $url): ?>
            
            <li class="nav-item">
                <a href="<?= $url ?>" class="nav-link">
                    <p class="text"><?= $label ?></p>
                </a>
            </li>
          
            <?php endforeach; ?>
        </ul><!-- /.ul -->
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <!-- Breadcrumbs -->
          <div class="breadcrumbs col">
            <?php 
              // Add multiple crumbs at the end of the trail
              $this->Breadcrumbs->add($breadcrumbsTrail??[]);
            
              echo $this->Breadcrumbs->render(
                ['class' => 'nav breadcrumbs-trail d-flex'],
                ['separator' => '<span class="mx-2 text-black"> / </span>']
              );
            ?>
          </div><!-- /.breadcrumbs col -->
        </div><!-- /.row -->
        <div class="row mb-2">
          <div class="col">
            <h1> <?= $pageTitle ?></h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?= $this->fetch('content') ?>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<?= $this->Html->script('plugins/jquery/jquery.min'); ?>
<!-- jQuery UI 1.11.4 -->
<?= $this->Html->script('plugins/jquery-ui/jquery-ui.min'); ?>
<!-- Jquery Validation -->
<?=  $this->Html->script('plugins/jquery-validation/jquery.validate.min'); ?>
<?=  $this->Html->script('common/validation'); ?>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<?= $this->Html->script('plugins/bootstrap/js/bootstrap.bundle.min'); ?>
<!-- daterangepicker -->
<?= $this->Html->script('plugins/moment/moment.min'); ?>
<?= $this->Html->script('plugins/daterangepicker/daterangepicker'); ?>
<!-- Tempusdominus Bootstrap 4 -->
<?= $this->Html->script('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min'); ?>
<!-- overlayScrollbars -->
<?= $this->Html->script('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min'); ?>
<!-- AdminLTE App -->
<?= $this->Html->script('plugins/adminlte.min'); ?>
<!-- View Script -->
<?= $this->fetch('scripts') ?>
</body>
</html>
