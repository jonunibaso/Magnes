<!-- main container -->
<div class="content">
  <div class="container-fluid">
    <div id="pad-wrapper" class="new-user">

      <div class="row-fluid header">
        <h3>Login</h3>
      </div>

      <div class="row-fluid form-wrapper">
        <!-- left column -->
        <div class="span8 with-sidebar">
          <div class="container well">

            <div id="infoMessage"><?php echo $message;?></div>

            <?php echo form_open("auth/login");?>

            <p>
             <div class="input-prepend">
              <span class="add-on"><i class="icon-envelope"></i></span>
              <input class="span12" placeholder="Email address" id="identity" type="text" name="identity">
            </div>
          </p>
          <p>
            <div class="input-prepend">
              <span class="add-on"><i class="icon-key"></i></span>
              <input class="span10" placeholder="Password"  id="password" type="password" name="password">
            </div>
          </p>
          <p>
            <?php echo lang('login_remember_label', 'remember');?>
            <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?>
          </p>


          <p><?php echo form_submit('submit', lang('login_submit_btn'));?></p>

          <?php echo form_close();?>

          <p><a href="forgot_password"><?php echo lang('login_forgot_password');?></a></p>

        </div>
      </div>

    </div>
</div>
