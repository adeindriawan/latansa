<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->
<div class="wrapper row1">
  <header id="header" class="clear"> 
    <!-- ################################################################################################ -->
    <div id="logo" class="fl_left">
      <h1><a href="<?php echo base_url() ?>">Pondok Pesantren La Tansa</a></h1>
      <p>Yayasan La Tansa Mashiro</p>
    </div>
    <div class="fl_right">
      <form class="clear" method="post" action="#">
        <fieldset>
          <legend>Search:</legend>
          <input type="text" value="" placeholder="Search Here">
          <button class="fa fa-search" type="submit" title="Search"><em>Search</em></button>
        </fieldset>
      </form>
    </div>
    <!-- ################################################################################################ --> 
  </header>
</div>
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->

<div class="wrapper row2">
  <div class="rounded">
    <header class="clearfix">
      <nav id="mainav" class="clear navbar navbar-default" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle offcanvas-toggle pull-right" data-toggle="offcanvas" data-target="#js-bootstrap-offcanvas" style="float:left;">
                <span class="sr-only">Toggle navigation</span>
                <span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                </span>
            </button>
          </div>
          <div class="navbar-offcanvas navbar-offcanvas-touch" id="js-bootstrap-offcanvas">
            <ul class="clear nav navbar-nav">
              <li class="daftarmenu <?php if ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == '') { ?>
                active
              <?php } elseif ($this->uri->segment(1) == '') { ?>
                active
              <?php } elseif ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'artikel') { ?>
                active
              <?php } ?>"><a class="daftarmenu" href="<?php echo base_url() ?>">Beranda</a></li>
              <li class="daftarmenu dropdownmenu drop"><a href="<?php echo site_url('home/sejarah') ?>">Profil</a>
                <ul>
                  <li><a href="<?php echo site_url('home/sejarah') ?>">Sejarah</a></li>
                  <li><a href="<?php echo site_url('home/visi') ?>">Visi dan Misi</a></li>
                  <li><a href="<?php echo site_url('home/filosofis') ?>">Landasan Filosofis</a></li>
                  <li><a href="<?php echo site_url('home/kepengurusan') ?>">Struktur Kepengurusan</a></li>
                </ul>
              </li>
              <li><a class="daftarmenu dropdownmenu drop" href="<?php echo site_url('home/kurikulum') ?>">Pengajaran</a>
                <ul>
                  <li><a href="<?php echo site_url('home/kurikulum') ?>">Kurikulum</a></li>
                  <li><a class="drop" href="<?php echo site_url('home/smp') ?>">Program Pendidikan</a>
                    <ul>
                      <li><a href="<?php echo site_url('home/smp') ?>">SMP</a></li>
                      <li><a href="<?php echo site_url('home/smp') ?>">SMA</a></li>
                      <li><a href="<?php echo site_url('home/smp') ?>">SMK</a></li>
                    </ul>
                  <li><a href="<?php echo site_url('home/pengajar') ?>">Tenaga Pengajar</a></li>
                  </li>
                </ul>
              </li>
              <li><a class="daftarmenu dropdownmenu drop" href="<?php echo site_url('home/rutinitas') ?>">Pengasuhan</a>
                <ul>
                  <li><a href="<?php echo site_url('home/rutinitas') ?>">Rutinitas Santri</a></li>
                  <li><a class="drop" href="<?php echo site_url('home/pengasuhan') ?>">Penegakan Disiplin</a>
                    <ul>
                      <li><a href="<?php echo site_url('home/pengasuhan') ?>">Bagian Pengasuhan</a></li>
                      <li><a href="<?php echo site_url('home/pengajaran') ?>">Bagian Pengajaran</a></li>
                      <li><a href="<?php echo site_url('home/bahasa') ?>">Bagian Bahasa</a></li>
                      <li><a href="<?php echo site_url('home/ubudiyyah') ?>">Bagian 'Ubudiyyah</a></li>
                    </ul>
                  <li><a href="<?php echo site_url('home/scoring') ?>"><em>Scoring System</em></a></li>
                  </li>
                </ul>
              </li>
              <li><a class="daftarmenu dropdownmenu drop" href="<?php echo site_url('home/aspa') ?>">Fasilitas</a>
                <ul>
                  <li><a href="<?php echo site_url('home/aspa') ?>">Asrama Putra</a></li>
                  <li><a href="<?php echo site_url('home/aspi') ?>">Asrama Putri</a></li>
                  <li><a href="<?php echo site_url('home/sekolah') ?>">Gedung Sekolah</a></li>
                  <li><a href="<?php echo site_url('home/fasilitas') ?>">Fasilitas Lainnya</a></li>
                </ul>
              </li>
              <li><a class="daftarmenu" href="<?php echo site_url('home/ekskul') ?>">Ekstrakurikuler</a></li>
              <li class="<?php if ($this->uri->segment(1) == 'home' && $this->uri->segment(2) == 'blog') { ?>
                active
              <?php } ?>"><a class="daftarmenu" href="<?php echo site_url('home/blog') ?>">Blog</a></li>
              <li><a class="daftarmenu" href="<?php echo site_url('home/galeri') ?>">Galeri</a></li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
  </div>
</div>
<script type="text/javascript">
  if ($(window).width() < 980) {
    $('.dropdownmenu').removeClass('drop');
  } else {
    $('.dropdownmenu').addClass('drop');
  }
</script>