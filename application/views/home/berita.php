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
    <?php if ($value->num_rows() > 0) { ?>
      <div id="portfolio">
        <ul class="nospace clear">
            <?php foreach ($value->result_array() as $key => $values) {
              if ($key%2 != 0) { ?>
                <li class="one_half">
                  <article><img class="borderedbox" src="<?php if ($values['gambar'] == NULL) { ?>
                    <?php echo base_url() ?>/images/artikel/list/no-image.png
                  <?php } else { ?>
                    <?php echo base_url() ?>/images/artikel/list/<?php echo $values['gambar'] ?>
                  <?php } ?>" alt="">
                    <h2><a href="<?php echo base_url() ?>home/artikel/<?php echo $values['id'] ?>"><?php echo $values['judul'] ?></a></h2>
                    <p><?php echo word_limiter($values['isi'], 10) ?></p>
                    <small><em>oleh: <a href="<?php echo site_url('home/profil') .'/' . $values['id_penulis'] ?>"><?php echo $values['username'] ?></a>, pada <?php echo $values['tanggal'] ?></em></small>
                    <p class="right"><a href="<?php echo base_url() ?>home/artikel/<?php echo $values['id'] ?>">Baca seterusnya &raquo;</a></p>
                  </article>
                </li>
              <?php } else { ?>
                <li class="one_half first">
                  <article><img class="borderedbox" src="<?php if ($values['gambar'] == NULL) { ?>
                    <?php echo base_url() ?>/images/artikel/list/no-image.png
                  <?php } else { ?>
                    <?php echo base_url() ?>/images/artikel/list/<?php echo $values['gambar'] ?>
                  <?php } ?>" alt="">
                    <h2><a href="<?php echo base_url() ?>home/artikel/<?php echo $values['id'] ?>"><?php echo $values['judul'] ?></a></h2>
                    <p><?php echo word_limiter($values['isi'], 10) ?></p>
                    <small><em>oleh: <a href="<?php echo site_url('home/profil') .'/' . $values['id_penulis'] ?>"><?php echo $values['username'] ?></a>, pada <?php echo $values['tanggal'] ?></em></small>
                    <p class="right"><a href="<?php echo base_url() ?>home/artikel/<?php echo $values['id'] ?>">Baca seterusnya &raquo;</a></p>
                  </article>
                </li>
              <?php } ?>
            <?php } ?>
        </ul>
        <?php echo $links; ?>
      </div>
      <?php } else { ?>
        <p>Tidak ada artikel.</p>
      <?php } ?>
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