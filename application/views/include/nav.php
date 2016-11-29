<div class="wrapper row0">
  <div id="topbar" class="clear"> 
    <!-- ################################################################################################ -->
    <nav>
      <ul>
        <li><a href="<?php echo base_url() ?>">Home</a></li>
        <li><a href="#">Contact Us</a></li>
        <li><a href="#">A - Z Index</a></li>
        <li><a href="#">Student Login</a></li>
        <?php if ($this->session->userdata('type') == 'admin') { ?>
           <li><a href="<?php echo site_url('staf') ?>">Admin Page</a></li>
        <?php } elseif ($this->session->userdata('type') == 'kontributor') { ?>
           <li><a href="<?php echo site_url('kontributor') ?>">Contributor Page</a></li>
        <?php } elseif ($this->session->userdata('type') == 'admin') { ?>
           <li><a href="<?php echo site_url('staf') ?>">Staff Page</a></li>
        <?php } ?>
        <li><a href="<?php if ($this->session->userdata('type') == 'administrator' || $this->session->userdata('type') == 'kontributor' || $this->session->userdata('type') == 'admin') {
          echo site_url('home/logout');
        } else {
          echo site_url('home/staff_login');
        } ?>"><?php if ($this->session->userdata('type') == 'administrator' || $this->session->userdata('type') == 'kontributor' || $this->session->userdata('type') == 'admin') { ?>
          Logout - <?php echo $this->session->userdata('username'); ?>
        <?php } else { ?>
          Staff Login
        <?php } ?></a></li>
      </ul>
    </nav>
    <!-- ################################################################################################ --> 
  </div>
</div>