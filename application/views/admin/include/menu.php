
<!-- HEADER SECTION -->
<div id="top">
  <nav class="navbar navbar-inverse navbar-fixed-top " style="padding-top: 10px;">
    <a data-original-title="Show/Hide Menu" data-placement="bottom" data-tooltip="tooltip" class="accordion-toggle btn btn-primary btn-sm visible-xs" data-toggle="collapse" href="#menu" id="menu-toggle">
        <i class="icon-align-justify"></i>
    </a>
    <!-- LOGO SECTION -->
    <header class="navbar-header">
        <a href="<?php echo base_url() ?>" class="navbar-brand"><img src="<?php echo base_url() ?>assets/bcore/assets/img/logo.png" alt="" /></a>
    </header>
    <!-- END LOGO SECTION -->
    <ul class="nav navbar-top-links navbar-right">
      <!-- MESSAGES SECTION -->
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="label label-success">2</span>    <i class="fa fa-envelope"></i>&nbsp; <i class="fa fa-chevron-down"></i>
        </a>
          <ul class="dropdown-menu dropdown-messages">
            <li>
              <a href="#">
                <div>
                   <strong>John Smith</strong>
                    <span class="pull-right text-muted">
                        <em>Today</em>
                    </span>
                </div>
                <div>Lorem ipsum dolor sit amet, consectetur adipiscing.
                    <br />
                    <span class="label label-primary">Important</span> 
                </div>
              </a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="#">
                  <div>
                      <strong>Raphel Jonson</strong>
                      <span class="pull-right text-muted">
                          <em>Yesterday</em>
                      </span>
                  </div>
                  <div>Lorem ipsum dolor sit amet, consectetur adipiscing.
                       <br />
                      <span class="label label-success"> Moderate </span> 
                  </div>
              </a>
            </li>
            <li class="divider"></li>
            <li>
              <a href="#">
                  <div>
                      <strong>Chi Ley Suk</strong>
                      <span class="pull-right text-muted">
                          <em>26 Jan 2014</em>
                      </span>
                  </div>
                  <div>Lorem ipsum dolor sit amet, consectetur adipiscing.
                       <br />
                      <span class="label label-danger"> Low </span> 
                  </div>
              </a>
            </li>
            <li class="divider"></li>
            <li>
                <a class="text-center" href="#">
                    <strong>Read All Messages</strong>
                    <i class="icon-angle-right"></i>
                </a>
            </li>
        </ul>
      </li>
      <!--END MESSAGES SECTION -->

      <!--TASK SECTION -->
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="label label-danger">5</span>   <i class="fa fa-tasks"></i>&nbsp; <i class="fa fa-chevron-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-tasks">
          <li>
            <a href="#">
                <div>
                    <p>
                        <strong> Profile </strong>
                        <span class="pull-right text-muted">40% Complete</span>
                    </p>
                    <div class="progress progress-striped active">
                        <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                            <span class="sr-only">40% Complete (success)</span>
                          </div>
                      </div>
                  </div>
              </a>
          </li>
          <li class="divider"></li>
          <li>
            <a href="#">
              <div>
                <p>
                  <strong>Pending Tasks </strong>
                  <span class="pull-right text-muted">20% Complete</span>
                </p>
                <div class="progress progress-striped active">
                  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
                      <span class="sr-only">20% Complete</span>
                  </div>
                </div>
              </div>
            </a>
          </li>
          <li class="divider"></li>
          <li>
            <a href="#">
              <div>
                <p>
                    <strong> Work Completed </strong>
                    <span class="pull-right text-muted">60% Complete</span>
                </p>
                <div class="progress progress-striped active">
                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                        <span class="sr-only">60% Complete (warning)</span>
                    </div>
                </div>
              </div>
            </a>
          </li>
          <li class="divider"></li>
          <li>
            <a href="#">
              <div>
                <p>
                  <strong> Summary </strong>
                  <span class="pull-right text-muted">80% Complete</span>
                </p>
                <div class="progress progress-striped active">
                  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                      <span class="sr-only">80% Complete (danger)</span>
                  </div>
                </div>
              </div>
            </a>
          </li>
          <li class="divider"></li>
          <li>
              <a class="text-center" href="#">
                  <strong>See All Tasks</strong>
                  <i class="icon-angle-right"></i>
              </a>
          </li>
        </ul>
      </li>
      <!--END TASK SECTION -->

      <!--ALERTS SECTION -->
      <li class="chat-panel dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <span class="label label-info">8</span>   <i class="fa fa-comments"></i>&nbsp; <i class="fa fa-chevron-down"></i>
        </a>
        <ul class="dropdown-menu dropdown-alerts">
          <li>
            <a href="#">
              <div>
                <i class="icon-comment" ></i> New Comment
                <span class="pull-right text-muted small"> 4 minutes ago</span>
              </div>
            </a>
          </li>
          <li class="divider"></li>
          <li>
            <a href="#">
              <div>
                <i class="icon-twitter info"></i> 3 New Follower
                <span class="pull-right text-muted small"> 9 minutes ago</span>
              </div>
            </a>
          </li>
          <li class="divider"></li>
          <li>
            <a href="#">
              <div>
                <i class="icon-envelope"></i> Message Sent
                <span class="pull-right text-muted small" > 20 minutes ago</span>
              </div>
            </a>
          </li>
          <li class="divider"></li>
          <li>
            <a href="#">
              <div>
                <i class="icon-tasks"></i> New Task
                <span class="pull-right text-muted small"> 1 Hour ago</span>
              </div>
            </a>
          </li>
          <li class="divider"></li>
          <li>
            <a href="#">
              <div>
                <i class="icon-upload"></i> Server Rebooted
                <span class="pull-right text-muted small"> 2 Hour ago</span>
              </div>
            </a>
          </li>
          <li class="divider"></li>
          <li>
            <a class="text-center" href="#">
              <strong>See All Alerts</strong>
              <i class="icon-angle-right"></i>
            </a>
          </li>
        </ul>
      </li>
      <!-- END ALERTS SECTION -->

      <!--ADMIN SETTINGS SECTIONS -->
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="fa fa-user "></i>&nbsp; <i class="fa fa-chevron-down "></i>
        </a>
        <ul class="dropdown-menu dropdown-user">
          <li>
            <a href="#"><i class="icon-user"></i> User Profile </a>
          </li>
          <li>
            <a href="#"><i class="icon-gear"></i> Settings </a>
          </li>
          <li class="divider"></li>
          <li>
            <a href="login.html"><i class="icon-signout"></i> Logout </a>
          </li>
        </ul>
      </li>
      <!--END ADMIN SETTINGS -->
    </ul>
  </nav>
</div>
<!-- END HEADER SECTION -->

<!-- MENU SECTION -->
<div id="left" >
  <div class="media user-media well-small">
    <a class="user-link" href="#">
        <img class="media-object img-thumbnail user-img" alt="User Picture" src="<?php echo base_url() ?>assets/bcore/assets/img/user.gif" />
    </a>
    <br />
    <div class="media-body">
        <h5 class="media-heading"> Joe Romlin</h5>
        <ul class="list-unstyled user-info">
          <li>
            <a class="btn btn-success btn-xs btn-circle" style="width: 10px;height: 12px;"></a> Online 
          </li>
        </ul>
    </div>
    <br />
  </div>
  <ul id="menu" class="collapse">
    <li class="panel <?php if ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == '') { ?>
      active
    <?php } ?>">
      <a href="<?php echo base_url() ?>admin" >
          <i class="fa fa-table"></i> Dashboard
      </a>                   
    </li>
    <li class="panel <?php if ($this->uri->segment(1) == 'admin' && $this->uri->segment(2) == 'data_artikel') { ?>
      active
    <?php } ?>">
        <a href="<?php echo base_url() ?>admin/data_artikel"><i class="fa fa-newspaper-o"> </i> Artikel     
           &nbsp; <span class="label label-default">10</span>&nbsp;
        </a>
    </li>
    <li class="panel ">
        <a href="#"><i class="fa fa-film"> </i> Galeri     
           &nbsp; <span class="label label-default">10</span>&nbsp;
        </a>
    </li>
    <li class="panel ">
        <a href="#"><i class="fa fa-user-secret"> </i> Staff     
           &nbsp; <span class="label label-default">10</span>&nbsp;
        </a>
    </li>
    <li><a href="gallery.html"><i class="fa fa-users"></i> Kontributor
        &nbsp; <span class="label label-default">10</span>&nbsp;
      </a>
    </li>
  </ul>
</div>
<!--END MENU SECTION -->