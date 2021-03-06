  <!-- BEGIN BODY -->
  <body class="padTop53 " >
  <?php $this->load->view('admin/include/head'); ?>
  <?php $this->load->view('admin/include/menu'); ?>
    <!-- MAIN WRAPPER -->
    <div id="wrap" >
          <!--PAGE CONTENT -->
          <div id="content">  
            <div class="inner" style="min-height: 700px;">
              <div class="row">
                <div class="col-lg-12">
                  <h1> Admin Dashboard </h1>
                </div>
              </div>
              <hr />

              <!--BLOCK SECTION -->
              <div class="row">
                <div class="col-lg-12">
                  <div style="text-align: center;">
                    <a class="quick-btn" href="#">
                        <i class="fa fa-pencil-square-o fa-2x"></i>
                        <span>Berita</span>
                        <span class="label label-danger">2</span>
                    </a>
                    <a class="quick-btn" href="#">
                        <i class="fa fa-eye fa-2x"></i>
                        <span>Blog</span>
                        <span class="label label-success">456</span>
                    </a>
                    <a class="quick-btn" href="#">
                        <i class="fa fa-commenting-o fa-2x"></i>
                        <span>Galeri</span>
                        <span class="label label-warning">+25</span>
                    </a>
                    <a class="quick-btn" href="#">
                        <i class="fa fa-comments fa-2x"></i>
                        <span>Komentar</span>
                        <span class="label label-default">20</span>
                    </a> 
                  </div>
                </div>
              </div>
              <!--END BLOCK SECTION -->
              <hr />

              <!-- COMMENT AND NOTIFICATION  SECTION -->
              <div class="row">
                <div class="col-lg-7">
                  <div class="chat-panel panel panel-success">
                    <div class="panel-heading">
                      <i class="icon-comments"></i>
                      New Comments
                    </div>
                    <div class="panel-body">
                      <ul class="chat">
                        <li class="left clearfix">
                          <span class="chat-img pull-left">
                              <img src="<?php echo base_url() ?>assets/bcore/assets/img/1.png" alt="User Avatar" class="img-circle" />
                          </span>
                          <div class="chat-body clearfix">
                            <div class="header">
                                <strong class="primary-font "> Jack Sparrow </strong>
                                <small class="pull-right text-muted label label-danger">
                                    <i class="fa fa-clock-o"></i> 12 mins ago
                                </small>
                            </div>
                            <br />
                            <p>
                              Lorem ipsum dolor sit amet, bibendum ornare dolor, quis ullamcorper ligula sodales.
                            </p>
                          </div>
                        </li>
                        <li class="right clearfix">
                          <span class="chat-img pull-right">
                              <img src="<?php echo base_url() ?>assets/bcore/assets/img/2.png" alt="User Avatar" class="img-circle" />
                          </span>
                          <div class="chat-body clearfix">
                            <div class="header">
                              <small class=" text-muted label label-info">
                                  <i class="fa fa-clock-o"></i> 13 mins ago</small>
                              <strong class="pull-right primary-font"> Jhony Deen</strong>
                            </div>
                            <br />
                            <p>
                                Lorem ipsum dolor sit amet, consectetur a dolor, quis ullamcorper ligula sodales.
                            </p>
                          </div>
                        </li>
                        <li class="left clearfix">
                          <span class="chat-img pull-left">
                            <img src="<?php echo base_url() ?>assets/bcore/assets/img/3.png" alt="User Avatar" class="img-circle" />
                          </span>
                          <div class="chat-body clearfix">
                            <div class="header">
                                <strong class="primary-font"> Jack Sparrow </strong>
                                <small class="pull-right text-muted label label-warning">
                                    <i class="fa fa-clock-o"></i> 12 mins ago
                                </small>
                            </div>
                            <br />
                            <p>
                              Lorem ipsum dolor sit amet, bibendum ornare dolor, quis ullamcorper ligula sodales.
                            </p>
                          </div>
                        </li>
                        <li class="right clearfix">
                          <span class="chat-img pull-right">
                            <img src="<?php echo base_url() ?>assets/bcore/assets/img/4.png" alt="User Avatar" class="img-circle" />
                          </span>
                          <div class="chat-body clearfix">
                            <div class="header">
                              <small class=" text-muted label label-primary">
                                <i class="fa fa-clock-o"></i> 13 mins ago</small>
                              <strong class="pull-right primary-font"> Jhony Deen</strong>
                            </div>
                            <br />
                            <p>
                              Lorem ipsum dolor sit amet, consectetur a dolor, quis ullamcorper ligula sodales.
                            </p>
                          </div>
                        </li>
                      </ul>
                    </div>
                    <div class="panel-footer">
                      <div class="input-group">
                        <input id="btn-input" type="text" class="form-control input-sm" placeholder="Type your comment here..." />
                        <span class="input-group-btn">
                          <button class="btn btn-success btn-sm" id="btn-chat">
                              Send
                          </button>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-lg-5">   
                  <div class="panel panel-danger">
                    <div class="panel-heading">
                        <i class="icon-bell"></i> Notifications Alerts Panel
                    </div>
                    <div class="panel-body">
                      <div class="list-group">
                        <a href="#" class="list-group-item">
                            <i class=" icon-comment"></i> New Comment
                          <span class="pull-right text-muted small"><em> 4 minutes ago</em>
                          </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="icon-twitter"></i> 3 New Followers
                          <span class="pull-right text-muted small"><em> 12 minutes ago</em>
                          </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="icon-envelope"></i> Message Sent
                          <span class="pull-right text-muted small"><em> 27 minutes ago</em>
                          </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="icon-tasks"></i> New Task
                          <span class="pull-right text-muted small"><em>43 minutes ago</em>
                          </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="icon-upload"></i> Server Rebooted
                          <span class="pull-right text-muted small"><em>11:32 AM</em>
                          </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="icon-warning-sign"></i> Server Crashed!
                          <span class="pull-right text-muted small"><em>11:13 AM</em>
                          </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class="icon-ok"></i> New Order Placed
                          <span class="pull-right text-muted small"><em>9:49 AM</em>
                          </span>
                        </a>
                        <a href="#" class="list-group-item">
                            <i class=" icon-money"></i> Payment Received
                          <span class="pull-right text-muted small"><em>Yesterday</em>
                          </span>
                        </a>
                      </div>
                      <a href="#" class="btn btn-default btn-block btn-primary">View All Alerts</a>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END COMMENT AND NOTIFICATION  SECTION -->
            </div>
          </div>
          <!--END PAGE CONTENT -->

           <!-- RIGHT STRIP  SECTION -->
          <div id="right">
            <div class="well well-small">
              <ul class="list-unstyled">
                  <li>Visitor &nbsp; : <span>23,000</span></li>
                  <li>Users &nbsp; : <span>53,000</span></li>
                  <li>Registrations &nbsp; : <span>3,000</span></li>
              </ul>
            </div>
            <div class="well well-small">
              <button class="btn btn-block"> Help </button>
              <button class="btn btn-primary btn-block"> Tickets</button>
              <button class="btn btn-info btn-block"> New </button>
              <button class="btn btn-success btn-block"> Users </button>
              <button class="btn btn-danger btn-block"> Profit </button>
              <button class="btn btn-warning btn-block"> Sales </button>
              <button class="btn btn-inverse btn-block"> Stock </button>
            </div>
            <div class="well well-small">
              <span>Profit</span><span class="pull-right"><small>20%</small></span>
              <div class="progress mini">
                <div class="progress-bar progress-bar-info" style="width: 20%"></div>
              </div>
              <span>Sales</span><span class="pull-right"><small>40%</small></span>
              <div class="progress mini">
                <div class="progress-bar progress-bar-success" style="width: 40%"></div>
              </div>
              <span>Pending</span><span class="pull-right"><small>60%</small></span>
              <div class="progress mini">
                <div class="progress-bar progress-bar-warning" style="width: 60%"></div>
              </div>
              <span>Summary</span><span class="pull-right"><small>80%</small></span>
              <div class="progress mini">
                <div class="progress-bar progress-bar-danger" style="width: 80%"></div>
              </div>
            </div>
          </div>
           <!-- END RIGHT STRIP  SECTION -->
    </div>
    <!--END MAIN WRAPPER -->

      <!-- FOOTER -->
      <div id="footer">
        <p>&copy;  binarytheme &nbsp;2014 &nbsp;</p>
      </div>
      <!--END FOOTER -->
  </body>
  <!-- END BODY -->