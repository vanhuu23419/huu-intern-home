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
  <!-- This Layout CSS -->
  <?= $this->Html->css('admin/login') ?>
  <!-- View CSS -->
  <?= $this->fetch('css') ?>
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 mx-auto">

                <?= $this->fetch('content') ?>
            </div>
        </div>
      </div><!-- /.container-fluid -->
    </section> <!-- /.content -->
</div>

<!-- jQuery -->
<?= $this->Html->script('plugins/jquery/jquery.min'); ?>
<!-- jQuery UI 1.11.4 -->
<?= $this->Html->script('plugins/jquery-ui/jquery-ui.min'); ?>
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
<!-- Jquery Validation -->
<?=  $this->Html->script('plugins/jquery-validation/jquery.validate.min'); ?>
<!-- View Script -->
<?= $this->fetch('scripts') ?>
</body>
</html>
