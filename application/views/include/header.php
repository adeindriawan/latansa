<!DOCTYPE html>
<!--
Template Name: Academic Education V2
Author: <a href="http://www.os-templates.com/">OS Templates</a>
Author URI: http://www.os-templates.com/
Licence: Free to use under our free template licence terms
Licence URI: http://www.os-templates.com/template-terms
-->
<html>
<head>
<title><?php if ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == '') { ?>
	PONPES LA TANSA | Beranda
<?php } elseif ($this->uri->segment(1) == '') { ?>
	PONPES LA TANSA
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'blog') { ?>
	PONPES LA TANSA | Blog
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'profil_kontributor') { ?>
	PONPES LA TANSA | Profil Kontributor
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'profil_staf') { ?>
	PONPES LA TANSA | Profil Staf
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'berita') { ?>
	PONPES LA TANSA | Berita
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'artikel') { ?>
	PONPES LA TANSA | Artikel
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'mengapa') { ?>
	PONPES LA TANSA | Mengapa Memilih La Tansa
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'pendaftaran') { ?>
	PONPES LA TANSA | Pendaftaran Santri Baru
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'pendidikan') { ?>
	PONPES LA TANSA | Pendidikan dan Pengalaman Santri
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'kiprah') { ?>
	PONPES LA TANSA | Kiprah Alumni La Tansa
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'sejarah') { ?>
	PONPES LA TANSA | Sejarah
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'visi') { ?>
	PONPES LA TANSA | Visi dan Misi
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'filosofis') { ?>
	PONPES LA TANSA | Landasan Filosofis
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'kepengurusan') { ?>
	PONPES LA TANSA | Struktur Kepengurusan
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'kurikulum') { ?>
	PONPES LA TANSA | Kurikulum
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'smp') { ?>
	PONPES LA TANSA | Pendidikan SMP
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'sma') { ?>
	PONPES LA TANSA | Pendidikan SMA
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'smk') { ?>
	PONPES LA TANSA | Pendidikan SMK
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'pengajar') { ?>
	PONPES LA TANSA | Tenaga Pengajar
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'rutinitas') { ?>
	PONPES LA TANSA | Rutinitas Santri
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'pengasuhan') { ?>
	PONPES LA TANSA | Penegakan Disiplin - Bagian Pengasuhan
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'pengajaran') { ?>
	PONPES LA TANSA | Penegakan Disiplin - Bagian Pengajaran
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'bahasa') { ?>
	PONPES LA TANSA | Penegakan Disiplin - Bagian Bahasa
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'ubudiyyah') { ?>
	PONPES LA TANSA | Penegakan Disiplin - Bagian 'Ubudiyyah
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'aspa') { ?>
	PONPES LA TANSA | Asrama Putra
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'aspi') { ?>
	PONPES LA TANSA | Asrama Putri
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'sekolah') { ?>
	PONPES LA TANSA | Gedung Sekolah
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'fasilitas') { ?>
	PONPES LA TANSA | Fasilitas Lainnya
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'ekskul') { ?>
	PONPES LA TANSA | Ekstrakurikuler
<?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'galeri') { ?>
	PONPES LA TANSA | Galeri
<?php } ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link rel="stylesheet" href="<?php echo base_url() ?>layout/styles/bootstrap.css" type="text/css" media="all">
<link href="<?php echo base_url() ?>layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo base_url() ?>layout/styles/style.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo base_url() ?>css/font-awesome.css" rel="stylesheet" type="text/css" media="all">
<link href="<?php echo base_url() ?>assets/plugins/bootstrap-offcanvas/dist/css/bootstrap.offcanvas.css" rel="stylesheet" type="text/css" media="all">
</head>
<body id="top" class="body-offcanvas">

<!-- JAVASCRIPTS --> 
<script src="<?php echo base_url() ?>layout/scripts/jquery.min.js"></script>
<script src="<?php echo base_url() ?>js/bootstrap.min.js"></script>
<script src="<?php echo base_url() ?>assets/plugins/bootstrap-offcanvas/dist/js/bootstrap.offcanvas.js"></script>
<script src="<?php echo base_url() ?>layout/scripts/jquery.fitvids.min.js"></script> 
<script src="<?php echo base_url() ?>layout/scripts/jquery.mobilemenu.js"></script> 
<script src="<?php echo base_url() ?>layout/scripts/tabslet/jquery.tabslet.min.js"></script>
<script src="<?php echo base_url() ?>/layout/scripts/nivo-lightbox/nivo-lightbox.min.js"></script>
</body>
</html>