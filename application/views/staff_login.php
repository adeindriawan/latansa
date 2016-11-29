<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Login Form</title>
    <link rel="stylesheet" href="<?php echo base_url() ?>css/staff_login.css"> 
  </head>
  <body>
    <div class="main-wrap">
        <div class="login-main">
          <?php echo form_open('home/staff_masuk'); ?>
            <input type="text" placeholder="user name" name="username" class="box1 border1">
            <br><?php echo form_error("username", "<code>", "</code>") ?>
            <input type="password" placeholder="password" name="password" class="box1 border2">
            <br><?php echo form_error("password", "<code>", "</code>") ?>
            <input type="submit" class="send" value="Go">
          <?php echo form_close(); ?>
            <p>Forgot Your Password? <a href="#">click here</a></p>    
        </div> 
    </div>
  </body>
</html>
