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
                <h3 class="panel-title">Profil Singkat</h3>
            </div>
            <div class="panel-body">
              <p><strong>Nama Lengkap:</strong></p>
              <p><?php echo $profil[0]['nama'] ?></p>
              <p><strong>Username:</strong></p>
              <p><?php echo $profil[0]['username'] ?></p>
              <p><strong>Tanggal Lahir:</strong></p>
              <p><?php echo $profil[0]['tanggal_lahir'] ?></p>
            </div>
          </div>
        </div>
        <div class="sdb_holder">
          <article>
            <h6>Motto Hidup</h6>
            <p><?php echo $profil[0]['motto'] ?></p>
          </article>
        </div>
        <!-- ################################################################################################ --> 
      </div>
      <!-- ################################################################################################ --> 
      <!-- ################################################################################################ -->
      <div id="content" class="three_quarter"> 
        <!-- ################################################################################################ -->
        <h1>Deskripsi Diri <?php echo $profil[0]['nama'] ?></h1>
        <?php if ($profil[0]['gambar'] != NULL) { ?>
          <img class="imgl borderedbox" src="<?php echo base_url() ?>/images/profil/halaman/<?php echo $profil[0]['gambar'] ?>" alt="">
        <?php } ?>
        <?php echo $profil[0]['deskripsi']; ?>
        <br><br>
        <div id="comments">
          <h2>Artikel-artikel</h2>
          <ul>
            <li>
              <article>
                <header>
                  <address>
                    <a href="#">A Name</a>
                  </address>
                  <time datetime="2045-04-06T08:15+00:00">Friday, 6<sup>th</sup> April 2045 @08:15:00</time>
                </header>
                <div class="comcont">
                  <p>This is an example of a comment made on a post. You can either edit the comment, delete the comment or reply to the comment. Use this as a place to respond to the post or to share what you are thinking.</p>
                </div>
              </article>
            </li>
            <li>
              <article>
                <header>
                  <address>
                    <a href="#">A Name</a>
                  </address>
                  <time datetime="2045-04-06T08:15+00:00">Friday, 6<sup>th</sup> April 2045 @08:15:00</time>
                </header>
                <div class="comcont">
                  <p>This is an example of a comment made on a post. You can either edit the comment, delete the comment or reply to the comment. Use this as a place to respond to the post or to share what you are thinking.</p>
                </div>
              </article>
            </li>
            <li>
              <article>
                <header>
                  <address>
                    <a href="#">A Name</a>
                  </address>
                  <time datetime="2045-04-06T08:15+00:00">Friday, 6<sup>th</sup> April 2045 @08:15:00</time>
                </header>
                <div class="comcont">
                  <p>This is an example of a comment made on a post. You can either edit the comment, delete the comment or reply to the comment. Use this as a place to respond to the post or to share what you are thinking.</p>
                </div>
              </article>
            </li>
          </ul>
        </div>
        <!-- ################################################################################################ --> 
      </div>
      <!-- ################################################################################################ --> 
      <!-- / main body -->
      <div class="clear"></div>
    </main>
  </div>
</div>
<?php $this->load->view('include/footer'); ?>
</body>
</html>