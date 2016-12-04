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
        <div class="sdb_holder">
          <div class="panel sidebar-menu">
            <div class="panel-heading">
                <h3 class="panel-title">Tags Artikel</h3>
            </div>
            <div class="panel-body">
              <ul class="tag-cloud">
                <?php foreach ($tags as $tag) { ?>
                  <li><a href="<?php echo base_url() ?>home/search_tag/<?php echo $tag['id'] ?>"><i class="fa fa-tags"></i><?php echo $tag['tags'] ?></a> 
                  </li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>
        <div class="sdb_holder">
          <article>
            <h6>Renungan Hari Ini</h6>
            <p>Nuncsed sed conseque a at quismodo tris mauristibus sed habiturpiscinia sed.</p>
            <ul>
              <li><a href="#">Lorem ipsum dolor sit</a></li>
              <li>Etiam vel sapien et</li>
              <li><a href="#">Etiam vel sapien et</a></li>
            </ul>
            <p>Nuncsed sed conseque a at quismodo tris mauristibus sed habiturpiscinia sed. Condimentumsantincidunt dui mattis magna intesque purus orci augue lor nibh.</p>
            <p class="more"><a href="#">Continue Reading &raquo;</a></p>
          </article>
        </div>
        <!-- ################################################################################################ --> 
      </div>
      <!-- ################################################################################################ --> 
      <!-- ################################################################################################ -->
      <div id="content" class="three_quarter"> 
        <!-- ################################################################################################ -->
        <h1><?php echo $artikel[0]['judul'] ?></h1>
        <?php if ($artikel[0]['gambar'] != NULL) { ?>
          <img class="imgr borderedbox" src="<?php echo base_url() ?>/images/artikel/gambar/<?php echo $artikel[0]['gambar'] ?>" alt="">
        <?php } ?>
        <?php echo $artikel[0]['isi']; ?>
        <p class="right">Oleh: <a href="<?php echo base_url() ?>home/profil/<?php echo $artikel[0]['id_penulis'] ?>"><?php echo $artikel[0]['username'] ?></a><?php echo " pada " . $artikel[0]['tanggal'] ?></p>
        <div id="comments">
          <h2>Komentar unutk artikel ini</h2>
          <ul id="kolom-komentar">
            <?php if ($komentar->num_rows() > 0) { ?>
              <?php foreach ($komentar->result_array() as $komen) { ?>
                <li>
                  <article>
                    <header>
                      <figure class="avatar"><img <?php if ($komen['avatar_komentator'] == NULL) { ?>
                        src="<?php echo base_url() ?>/images/demo/avatar.png" alt=""
                      <?php } else { ?>
                        src="<?php echo base_url() ?>/images/profil/avatar/<?php echo $komen['avatar_komentator'] ?>" alt=""
                      <?php } ?>
                      >
                      </figure>
                      <address>
                      <?php echo $komen['nama_komentator'] ?>
                      </address>
                      <time datetime="2045-04-06T08:15+00:00">pada <?php echo $komen['tanggal_komentar'] ?></time>
                    </header>
                    <div class="comcont">
                      <p><?php echo $komen['isi_komentar'] ?></p>
                    </div>
                  </article>
                </li>
              <?php } ?>
            <?php } else { ?>
              <p>Belum ada komentar pada artikel ini.</p>
            <?php } ?>
          </ul>
          <h2>Tulis komentar</h2>
          <?php if ($this->session->userdata('id') == 0) { ?>
            <form role="form" id="form-komentar">
              <div class="one_third first">
                <label for="name">Nama <span>*</span></label>
                <input type="text" name="nama" id="name" value="" size="22">
              </div>
              <div class="one_third">
                <label for="email">E-Mail <span>*</span></label>
                <input type="text" name="email" id="email" value="" size="22">
              </div>
              <div class="one_third">
                <label for="url">Website</label>
                <input type="text" name="website" id="url" value="" size="22">
              </div>
              <div class="block clear">
                <label for="comment">Komentar Anda</label>
                <textarea name="komentar" id="comment" cols="25" rows="10"></textarea>
              </div>
              <div>
                <input type="button" class="btn btn-default" id="submitKomentar" value="Kirim Komentar">
                &nbsp;
                <input type="button" class="btn btn-default" id="batal" value="Batal">
              </div>
            </form>
            <script type="text/javascript">
              $(document).ready(function() {
                var link = "<?php echo base_url() ?>";
                $("#submitKomentar").click(function(event) {
                  var jud = "<?php echo $artikel[0]['judul'] ?>";
                  var art = "<?php echo $this->uri->segment(3) ?>";
                  var tgl = "<?php echo date('Y-m-d H:i:s') ?>";
                  var nam = $("#form-komentar").find('input[name="nama"]').val();
                  var ema = $("#form-komentar").find('input[name="email"]').val();
                  var web = $("#form-komentar").find('input[name="website"]').val();
                  var kom = $("#form-komentar").find('textarea[name="komentar"]').val();
                  /* Act on the event */
                  $.post(link + 'home/tambah_komentar', {artikel: art, nama: nam, email: ema, website: web, komentar: kom, judul: jud, ajax: 1}, function(data) {
                    /*optional stuff to do after success */
                    if (data == 'false') {
                      $("#gglModal").modal("show");
                    } else{
                      $("#kolom-komentar").prepend("<li>" + 
                                                  "<article>" +
                                                  "<header>" +
                                                  "<figure class='avatar'><img src='<?php echo base_url() ?>/images/demo/avatar.png' alt=''></figure>" +
                                                  "<address>" + nam + "</address>" +
                                                  "<time datetime='2045-04-06T08:15+00:00'>pada " + tgl + "</time>" +
                                                  "</header>" +
                                                  "<div class='comcont'>" + kom + "</div>" +
                                                  "</article>" +
                                                  "</li>");
                      $("#sksModal").modal("show");
                    };
                  });
                });
                $("#batal").click(function(event) {
                  var nam = $("#form-komentar").find('input[name="nama"]').val();
                  var ema = $("#form-komentar").find('input[name="email"]').val();
                  var web = $("#form-komentar").find('input[name="website"]').val();
                  var kom = $("#form-komentar").find('textarea[name="komentar"]').val();
                  /* Act on the event */
                  nam.val("");
                  ema.val("");
                  web.val("");
                  kom.val("");
                });
              });
            </script>
          <?php } else { ?>
            <form role="form" id="form-komentar">
              <label><span id="username"><?php echo $this->session->userdata('username'); ?></span></label>
              <div class="block clear">
                <label for="comment">Komentar Anda</label>
                <textarea name="komentar" id="comment" cols="25" rows="10"></textarea>
              </div>
              <div>
                <input type="button" class="btn btn-default" id="submitKomentar" value="Kirim Komentar">
                &nbsp;
                <input type="button" class="btn btn-default" id="batal" value="Batal">
              </div>
            </form>
            <script type="text/javascript">
              $(document).ready(function() {
                var link = "<?php echo base_url() ?>";
                $("#submitKomentar").click(function(event) {
                  var jud = "<?php echo $artikel[0]['judul'] ?>";
                  var art = "<?php echo $this->uri->segment(3) ?>";
                  var tgl = "<?php echo date('Y-m-d H:i:s') ?>";
                  var nam = $("#username").text();
                  var kom = $("#form-komentar").find('textarea[name="komentar"]').val();
                  var ava = "<?php echo $this->session->userdata('type'); ?>" + "_" + "<?php echo $this->session->userdata('username'); ?>" + ".jpg";
                  /* Act on the event */
                  $.post(link + 'home/tambah_komentar', {artikel: art, nama: nam, komentar: kom, avatar: ava, judul: jud, ajax: 1}, function(data) {
                    /*optional stuff to do after success */
                    if (data == 'false') {
                      $("#gglModal").modal("show");
                    } else{
                      $("#kolom-komentar").prepend("<li>" + 
                                                  "<article>" +
                                                  "<header>" +
                                                  "<figure class='avatar'><img src='<?php echo base_url() ?>/images/profil/avatar/'" + ava + " alt=''></figure>" +
                                                  "<address>" + nam + "</address>" +
                                                  "<time datetime='2045-04-06T08:15+00:00'>pada " + tgl + "</time>" +
                                                  "</header>" +
                                                  "<div class='comcont'>" + kom + "</div>" +
                                                  "</article>" +
                                                  "</li>");
                      $("#sksModal").modal("show");
                    };
                  });
                });
                $("#batal").click(function(event) {
                  var nam = $("#form-komentar").find('input[name="nama"]').val();
                  var ema = $("#form-komentar").find('input[name="email"]').val();
                  var web = $("#form-komentar").find('input[name="website"]').val();
                  var kom = $("#form-komentar").find('textarea[name="komentar"]').val();
                  /* Act on the event */
                  nam.val("");
                  ema.val("");
                  web.val("");
                  kom.val("");
                });
              });
            </script>
          <?php } ?>
        </div>
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
<div class="modal fade" id="gglModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel" style="color:black;">Dialog</h4>
        </div>
        <div class="modal-body" style="color:black;">
          Gagal mengirim komentar!
        </div>
      </div>
    </div>
</div>
<div class="modal fade" id="sksModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="exampleModalLabel" style="color:black">Dialog</h4>
        </div>
        <div class="modal-body" style="color:black;">
          Sukses mengirim komentar!
        </div>
      </div>
    </div>
</div>
</body>
</html>