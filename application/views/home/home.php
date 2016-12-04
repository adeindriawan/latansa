<?php $this->load->view('include/header'); ?>
<?php $this->load->view('include/nav'); ?>
<?php $this->load->view('include/menu'); ?>
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->
<div class="wrapper">
  <div id="slider">
    <div id="slide-wrapper" class="rounded clear"> 
      <!-- ################################################################################################ -->
      <?php foreach ($halaman->result_array() as $key => $value) { ?>
        <figure id="slide-<?php echo $key+1 ?>"><a class="view" href="#"><img src="<?php echo base_url() ?>images/halaman/slider/<?php echo $value['gambar_halaman'] ?>" alt=""></a>
          <figcaption>
            <h2><?php echo $value['nama_halaman'] ?></h2>
            <p><?php echo word_limiter($value['isi_halaman'], 10) ?></p>
            <p class="right"><a href="<?php echo site_url('home/'.$value['alamat']) ?>">Lanjutkan membaca &raquo;</a></p>
          </figcaption>
        </figure>
      <?php } ?>
      <!-- ################################################################################################ -->
      <ul id="slide-tabs">
        <li><a href="#slide-1">Mengapa Memilih La Tansa?</a></li>
        <li><a href="#slide-2">Informasi Santri Baru</a></li>
        <li><a href="#slide-3">Pendidikan dan Kegiatan Santri</a></li>
        <li><a href="#slide-4">Kiprah Para Alumni La Tansa</a></li>
        <li><a href="#slide-5">Berita &amp; Acara Pondok Terbaru</a></li>
      </ul>
      <!-- ################################################################################################ --> 
    </div>
  </div>
</div>
<!-- ################################################################################################ --> 
<!-- ################################################################################################ --> 
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <div class="rounded">
    <main class="container clear"> 
      <!-- main body --> 
      <!-- ################################################################################################ -->
      <div class="group btmspace-30"> 
        <!-- Middle Column -->
        <div class="three_quarter first"> 
          <!-- ################################################################################################ -->
          <h2>Berita &amp; Kegiatan Terkini</h2>
          <ul class="nospace listing">
            <?php foreach ($posts->result_array() as $post) { ?>
              <li class="clear">
                <div class="imgl borderedbox"><img src="<?php if ($post['gambar'] == NULL) { ?>
                  <?php echo base_url() ?>images/artikel/thumbnail/no-image.gif 
                <?php } else { ?>
                  <?php echo base_url()?>images/artikel/thumbnail/<?php echo $post['gambar'] ?>
                <?php } ?>" alt=""></div>
                <p class="nospace btmspace-15"><a href="<?php echo site_url('home/artikel') ?>/<?php echo $post['id'] ?>"><?php echo $post['judul'] ?></a></p>
                <p><?php echo word_limiter($post["isi"], 15) ?></p>
                <small><em>oleh: <a href="<?php echo site_url('home/profil') .'/' . $post['id_penulis'] ?>"><?php echo $post['username'] ?></a>, pada <?php echo $post['tanggal'] ?></em></small>
                <p class="right"><a href="<?php echo site_url('home/artikel') ?>/<?php echo $post['id'] ?>">Baca selanjutnya &raquo;</a></p>
              </li>
            <?php } ?>
          </ul>
          <p class="right"><a href="<?php echo site_url('home/berita') ?>">Klik di sini untuk mengetahui berita dan kegiatan terbaru selengkapnya &raquo;</a></p>
          <!-- ################################################################################################ --> 
        </div>
        <!-- / Middle Column --> 
        <!-- Right Column -->
        <div class="one_quarter sidebar"> 
          <!-- ################################################################################################ -->
          <div class="sdb_holder">
            <h6>Keliling Pondok</h6>
            <div class="mediacontainer"><img src="<?php echo base_url() ?>images/demo/video.gif" alt="">
              <p><a href="#">View More Tour Videos Here</a></p>
            </div>
          </div>
          <div class="sdb_holder">
            <h6>Info Singkat</h6>
            <ul class="nospace quickinfo">
              <li class="clear"><a href="#"><img src="<?php echo base_url() ?>images/demo/80x80.gif" alt=""> Brosur Ponpes La Tansa</a></li>
              <li class="clear"><a href="#"><img src="<?php echo base_url() ?>images/demo/80x80.gif" alt=""> Kesempatan Mengajar di La Tansa</a></li>
            </ul>
          </div>
          <!-- ################################################################################################ --> 
        </div>
        <!-- / Right Column --> 
      </div>
      <!-- ################################################################################################ --> 
      <!-- ################################################################################################ -->
      <div class="group">
        <h2>Temukan apa yang ingin Anda cari dengan cepat</h2>
        <div class="one_quarter first"> 
          <!-- ################################################################################################ -->
          <ul class="nospace">
            <li><a href="#">Academic Advisory</a></li>
            <li><a href="#">Academic Assistance</a></li>
            <li><a href="#">Academic Calendars</a></li>
            <li><a href="#">Academics Office</a></li>
            <li><a href="#">Administration</a></li>
            <li><a href="#">Adult Learners</a></li>
            <li><a href="#">Alumni Chapters</a></li>
            <li><a href="#">Alumni Events</a></li>
            <li><a href="#">Athletics</a></li>
            <li><a href="#">Campus Life At a Glance</a></li>
            <li><a href="#">Campus Recreation</a></li>
            <li><a href="#">Campus Safety &amp; Security</a></li>
          </ul>
          <!-- ################################################################################################ --> 
        </div>
        <div class="one_quarter"> 
          <!-- ################################################################################################ -->
          <ul class="nospace">
            <li><a href="#">Class Schedules</a></li>
            <li><a href="#">Counselling Center</a></li>
            <li><a href="#">Course Descriptions &amp; Catalogue</a></li>
            <li><a href="#">Department Directory</a></li>
            <li><a href="#">Departments &amp; Programs</a></li>
            <li><a href="#">Fellowships</a></li>
            <li><a href="#">Finals Schedules</a></li>
            <li><a href="#">Financial Aid</a></li>
            <li><a href="#">Fitness and Recreation Facilities</a></li>
            <li><a href="#">Global Learning</a></li>
            <li><a href="#">Graduate</a></li>
            <li><a href="#">Graduate Admissions</a></li>
          </ul>
          <!-- ################################################################################################ --> 
        </div>
        <div class="one_quarter"> 
          <!-- ################################################################################################ -->
          <ul class="nospace">
            <li><a href="#">Graduate Health Services</a></li>
            <li><a href="#">Graduate Housing</a></li>
            <li><a href="#">Graduate Programs</a></li>
            <li><a href="#">Graduate Student Association</a></li>
            <li><a href="#">Graduate Studies</a></li>
            <li><a href="#">Honours Program</a></li>
            <li><a href="#">Interactive Schedule</a></li>
            <li><a href="#">International Programs</a></li>
            <li><a href="#">International Students</a></li>
            <li><a href="#">Intramural Sports</a></li>
            <li><a href="#">Language Resources</a></li>
            <li><a href="#">Maps and Directions</a></li>
          </ul>
          <!-- ################################################################################################ --> 
        </div>
        <div class="one_quarter"> 
          <!-- ################################################################################################ -->
          <ul class="nospace">
            <li><a href="#">Office of the Registrar</a></li>
            <li><a href="#">Online Learning</a></li>
            <li><a href="#">Parent Information</a></li>
            <li><a href="#">Residence Life</a></li>
            <li><a href="#">Residential Colleges</a></li>
            <li><a href="#">Schools and Colleges</a></li>
            <li><a href="#">Student Activities</a></li>
            <li><a href="#">Student Affairs</a></li>
            <li><a href="#">Student Development</a></li>
            <li><a href="#">Student Financial Services</a></li>
            <li><a href="#">Student Group Directory</a></li>
            <li><a href="#">Student Life</a></li>
          </ul>
          <!-- ################################################################################################ --> 
        </div>
      </div>
      <!-- ################################################################################################ --> 
      <!-- / main body -->
      <div class="clear"></div>
    </main>
  </div>
</div>
<?php if ($this->session->flashdata('sesi_habis')) { ?>
    <div class="modal fade" id="sesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel" style="color:black;">Dialog</h4>
                </div>
                <div class="modal-body" style="color:black;">
                <?php echo $this->session->flashdata('sesi_habis'); ?>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#sesModal').modal({
                'show':true,
                'keyboard': false
            });
        });
    </script>
<?php } ?>
<?php if ($this->session->flashdata('eror_login')) { ?>
    <div class="modal fade" id="errModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="exampleModalLabel" style="color:black">Dialog</h4>
                </div>
                <div class="modal-body" style="color:black">
                <?php echo $this->session->flashdata('eror_login'); ?>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#errModal').modal({
                'show':true,
                'keyboard': false
            });
        });
    </script>
<?php } ?>
<?php $this->load->view('include/footer'); ?>