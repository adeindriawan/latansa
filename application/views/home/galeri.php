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
      <div id="gallery">
        <figure>
            <?php if (!$data1) { ?>
              Belum ada Galeri yang dibuat.
            <?php } else { ?>
              <?php foreach ($data1 as $key => $value) { ?>
          <header class="heading"><?php echo $value[0]["judul_galeri"] ?></header>
          <ul class="nospace clear">
                <?php foreach ($value as $key => $values) {?>
                	<?php if ($key == 0 || $key%4 == 0) { ?>
	                  <li class="one_quarter first"><a class="nlb" data-lightbox-gallery="gallery1" href="<?php echo base_url() ?>images/galeri/view/<?php echo $value[$key]["path_view"] ?>" title="<?php echo $value[$key]["caption"] ?>"><img class="borderedbox" src="<?php echo base_url() ?>images/galeri/thumbnail/<?php echo $value[$key]["path_view"] ?>" alt=""></a></li>
	                <?php } else { ?>
	                  <li class="one_quarter"><a class="nlb" data-lightbox-gallery="gallery1" href="<?php echo base_url() ?>images/galeri/view/<?php echo $value[$key]["path_view"] ?>" title="<?php echo $value[$key]["caption"] ?>"><img class="borderedbox" src="<?php echo base_url() ?>images/galeri/thumbnail/<?php echo $value[$key]["path_view"] ?>" alt=""></a></li>
	                <?php } ?>
                <?php } ?>
              <?php } ?>
            <?php } ?>
          </ul>
          <figcaption><?php echo $value[0]["deskripsi_galeri"] ?></figcaption>
        </figure>
      </div>
      <!-- ################################################################################################ --> 
      <!-- ################################################################################################ -->
      <?php echo $data2; ?>
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