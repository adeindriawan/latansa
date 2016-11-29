<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="UTF-8" />
    <title><?php if ($this->uri->segment(1) == "admin" && $this->uri->segment(2) == "") { ?>
        Admin | Dashboard
    <?php } elseif ($this->uri->segment(1) == "admin" && $this->uri->segment(2) == "data_artikel") { ?>
        Admin | Data Artikel
    <?php } ?></title>
     <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="" name="description" />
  <meta content="" name="author" />
     <!--[if IE]>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <![endif]-->
    <!-- GLOBAL STYLES -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bcore/assets/plugins/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bcore/assets/css/main.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bcore/assets/css/theme.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bcore/assets/css/MoneAdmin.css" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bcore/assets/plugins/Font-Awesome/css/font-awesome.css" />
    <link href="<?php echo base_url() ?>css/bootstrap-table.css" rel="stylesheet" type="text/css" media="all">
    <!--END GLOBAL STYLES -->

    <!-- PAGE LEVEL STYLES -->
    <link href="<?php echo base_url() ?>assets/bcore/assets/css/layout2.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bcore/assets/plugins/timeline/timeline.css" />
    <!-- END PAGE LEVEL  STYLES -->
     <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
    <style type="text/css">
    </style>

    <!-- GLOBAL SCRIPTS -->
    <script src="<?php echo base_url() ?>assets/bcore/assets/plugins/jquery-2.0.3.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bcore/assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bcore/assets/plugins/modernizr-2.6.2-respond-1.1.0.min.js"></script>
    <!-- END GLOBAL SCRIPTS -->

    <!-- PAGE LEVEL SCRIPTS -->
    <script src="<?php echo base_url() ?>assets/bcore/assets/js/for_index.js"></script>
    <!-- END PAGE LEVEL SCRIPTS -->
</head>
    <!-- END HEAD -->
