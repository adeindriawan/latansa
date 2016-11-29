<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/nav'); ?>
<?php $this->load->view('include/menu'); ?>
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <div class="rounded">
    <main class="container clear"> 
      <!-- main body --> 
      <!-- ################################################################################################ -->
      <div class="sidebar one_quarter first"> 
        <h6>Navigasi Menu</h6>
        <nav class="sdb_holder">
          <ul>
            <li><a href="<?php echo base_url() ?>">Beranda</a></li>
            <li><a href="<?php echo site_url('home/sejarah') ?>">Profil</a>
              <ul>
                <li><a href="<?php echo site_url('home/sejarah') ?>">Sejarah</a></li>
                <li><a href="<?php echo site_url('home/visi') ?>">Visi dan Misi</a></li>
                <li><a href="<?php echo site_url('home/filosofis') ?>">Landasan Filosofis</a></li>
                <li><a href="<?php echo site_url('home/kepengurusan') ?>">Struktur Kepengurusan</a></li>
              </ul>
            </li>
            <li><a href="<?php echo site_url('home/kurikulum') ?>">Pengajaran</a>
              <ul>
                <li><a href="<?php echo site_url('home/kurikulum') ?>">Kurikulum</a></li>
                <li><a href="<?php echo site_url('home/smp') ?>">Program Pendidikan</a>
                  <ul>
                    <li><a href="<?php echo site_url('home/smp') ?>">SMP</a></li>
                    <li><a href="<?php echo site_url('home/sma') ?>">SMA</a></li>
                    <li><a href="<?php echo site_url('home/smk') ?>">SMK</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="<?php echo site_url('home/rutinitas') ?>">Pengasuhan</a>
              <ul>
                <li><a href="<?php echo site_url('home/rutinitas') ?>">Rutinitas</a></li>
                <li><a href="<?php echo site_url('home/pengasuhan') ?>">Penegakan Disiplin</a>
                  <ul>
                    <li><a href="<?php echo site_url('home/pengasuhan') ?>">Bagian Pengasuhan</a></li>
                    <li><a href="<?php echo site_url('home/pengajaran') ?>">Bagian Pengajaran</a></li>
                    <li><a href="<?php echo site_url('home/bahasa') ?>">Bagian Bahasa</a></li>
                    <li><a href="<?php echo site_url('home/ubudiyyah') ?>">Bagian 'Ubudiyyah'</a></li>
                  </ul>
                </li>
                <li><a href="<?php echo site_url('home/scoring') ?>"><em>Scoring System</em></a></li>
              </ul>
            </li>
            <li><a href="<?php echo site_url('home/aspa') ?>">Fasilitas</a>
              <ul>
                <li><a href="<?php echo site_url('home/aspa') ?>">Asrama Putra</a></li>
                <li><a href="<?php echo site_url('home/aspi') ?>">Asrama Putri</a></li>
                <li><a href="<?php echo site_url('home/sekolah') ?>">Gedung Sekolah</a></li>
                <li><a href="<?php echo site_url('home/fasilitas') ?>">Fasilitas Lainnya</a></li>
              </ul>
            </li>
            <li><a href="<?php echo site_url('home/ekskul') ?>">Ekstrakurikuler</a></li>
          </ul>
        </nav>
        <div class="sdb_holder">
          <article>
            <h6>Renungan Hari Ini</h6>
            <p>Nuncsed sed conseque a at quismodo tris mauristibus sed habiturpiscinia sed.</p>
            <p>Nuncsed sed conseque a at quismodo tris mauristibus sed habiturpiscinia sed. Condimentumsantincidunt dui mattis magna intesque purus orci augue lor nibh.</p>
          </article>
        </div>
        <!-- ################################################################################################ --> 
      </div>
      <!-- ################################################################################################ --> 
      <!-- ################################################################################################ -->
      <div id="content" class="three_quarter"> 
        <!-- ################################################################################################ -->
        <h1><?php echo $halaman[0]['nama_halaman'] ?></h1>
        <?php if ($halaman[0]['gambar_halaman'] != NULL) { ?>
          <img class="imgr borderedbox" src="<?php echo base_url() ?>/images/halaman/halaman/<?php echo $halaman[0]['gambar_halaman'] ?>" alt="">
        <?php } ?>
        <?php echo $halaman[0]['isi_halaman']; ?>
        <p class="right"><?php echo $halaman[0]['keterangan'] ?></p>
        
        <!-- ################################################################################################ --> 
      </div>
      <!-- ################################################################################################ --> 
      <!-- / main body -->
      <div class="clear"></div>
    </main>
  </div>
</div>
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->
<?php $this->load->view('include/footer'); ?>
</body>
</html>