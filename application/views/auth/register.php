<!-- main container -->
<div class="content">
  <div class="container-fluid">
    <div id="pad-wrapper" class="new-user">

      <div class="row-fluid header">
        <h3>Register new user</h3>
      </div>

      <div class="row-fluid form-wrapper">
        <!-- left column -->
        <div class="span8 with-sidebar">
          <div class="container well">

            <? if(validation_errors() != false) { ?>
            <div class="alert alert-error">
              <i class="icon-remove-sign"></i>
              <?php echo validation_errors(); ?>
            </div>
            <? } ?>

            <form class="new_user_form inline-input" method="post" action="<? echo base_url('auth/input'); ?>" >
              <div class="span12 field-box">
                <label>Nick:</label>
                <input class="span9" type="text" id="nick" name="nick" placeholder="Nick" <? if(isset($nick)) { echo "value='".$nick."'"; }?>>
              </div>
              <div class="span12 field-box">
                <label>Email:</label>
                <input class="span9" type="text" id="email" name="email" placeholder="Email" <? if(isset($email)) { echo "value='".$email."'"; }?>>
              </div>
              <div class="span12 field-box">
                <label>Password:</label>
                <input class="span9" type="Password" id="password" name="password" placeholder="Password">
              </div>
              <div class="span12 field-box">
                <label>Repeat:</label>
                <input class="span9" type="Password" id="password2" name="password2" placeholder="Re-enter Password">
              </div>
              <div class="span11 field-box actions">
                <input type="submit" class="btn-glow primary" value="Create user">
              </div>
            </form>
          </div>
        </div>

        <!-- side right column -->
        <div class="span3 form-sidebar pull-right">
          <div class="alert alert-info">
            <i class="icon-lightbulb pull-left"></i>
            Facebook Registrarion Coming Soon<br>
            Twitter  Registrarion Coming Soon
          </div>                        
        </div>
      </div>

    </div>
  </div>
</div>

<!-- end main container -->
