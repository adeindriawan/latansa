
<!-- MENU SECTION -->
<div id="left" >
  <div class="media user-media well-small">
    <a class="user-link" href="#">
        <img class="media-object img-thumbnail user-img" alt="User Picture" src="<?php if ($profil[0]['gambar'] == NULL) { ?>
          <?php echo base_url() ?>images/profil/thumbnail/no-image.gif
        <?php } else { ?>
          <?php echo base_url() ?>images/profil/thumbnail/<?php echo $profil[0]['gambar'] ?>
        <?php } ?>" />
    </a>
    <br />
    <div class="media-body">
        <h5 class="media-heading"><?php echo $profil[0]['username'] ?></h5>
        <ul class="list-unstyled user-info">
          <li>
            <a class="btn btn-success btn-xs btn-circle" style="width: 10px;height: 12px;"></a> Online 
          </li>
        </ul>
    </div>
    <br />
  </div>
  <ul id="menu" class="collapse">
    <li class="panel <?php if ($this->uri->segment(1) == 'staf' && $this->uri->segment(2) == '') { ?>
      active
    <?php } ?>">
      <a href="<?php echo base_url() ?>staf" >
          <i class="fa fa-table"></i> Dashboard
      </a>                   
    </li>
    <li class="panel <?php if ($this->uri->segment(1) == 'staf' && $this->uri->segment(2) == 'data_halaman') { ?>
      active
    <?php } ?>">
        <a href="<?php echo base_url() ?>staf/data_halaman"><i class="fa fa-map-o"> </i> Halaman     
           &nbsp; <span class="label label-default"><?php echo $jumlah_halaman ?></span>&nbsp;
        </a>
    </li>
    <li class="panel <?php if ($this->uri->segment(1) == 'staf' && $this->uri->segment(2) == 'data_artikel') { ?>
      active
    <?php } ?>">
        <a href="<?php echo base_url() ?>staf/data_artikel"><i class="fa fa-newspaper-o"> </i> Artikel     
           &nbsp; <span class="label label-default"><?php echo $jumlah_artikel ?></span>&nbsp;
        </a>
    </li>
    <li class="panel <?php if ($this->uri->segment(1) == 'staf' && $this->uri->segment(2) == 'data_galeri') { ?>
      active
    <?php } ?>">
        <a href="<?php echo site_url('staf/data_galeri') ?>"><i class="fa fa-film"> </i> Galeri     
           &nbsp; <span class="label label-default"><?php echo $jumlah_galeri ?></span>&nbsp;
        </a>
    </li>
    <li class="panel <?php if ($this->uri->segment(1) == 'staf' && $this->uri->segment(2) == 'profil') { ?>
      active
    <?php } ?>">
        <a href="<?php echo site_url('staf/profil')."/".$this->session->userdata("id") ?>"><i class="fa fa-user-circle-o"> </i> Profil
        </a>
    </li>
  </ul>
</div>
<!--END MENU SECTION -->