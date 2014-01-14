<!-- main container -->
<div class="content">
	<div class="container-fluid">
		<div id="pad-wrapper" class="new-user">

			<div class="row-fluid header">
				<h3>Change Password</h3>
			</div>

			<div class="row-fluid form-wrapper">
				<!-- left column -->
				<div class="span8 with-sidebar">
					<div class="container well">

						<div id="infoMessage"><?php echo $message;?></div>

						<?php echo form_open('auth/reset_password/' . $code);?>

						<p>
							<label for="new_password"><?php echo sprintf(lang('reset_password_new_password_label'), $min_password_length);?></label> <br />
							<?php echo form_input($new_password);?>
						</p>

						<p>
							<?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm');?> <br />
							<?php echo form_input($new_password_confirm);?>
						</p>

						<?php echo form_input($user_id);?>
						<?php echo form_hidden($csrf); ?>

						<p><?php echo form_submit('submit', lang('reset_password_submit_btn'));?></p>

						<?php echo form_close();?>

					</div>
				</div>

			</div>


		</div>
	</div>
</div>