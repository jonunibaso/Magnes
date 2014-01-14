<!-- main container -->
<div class="content">
	<div class="container-fluid">
		<div id="pad-wrapper" class="new-user">

			<div class="row-fluid header">
				<h3>Forgot Password</h3>
			</div>

			<div class="row-fluid form-wrapper">
				<!-- left column -->
				<div class="span8 with-sidebar">
					<div class="container well">
						<p><?php echo sprintf(lang('forgot_password_subheading'), $identity_label);?></p>

						<div id="infoMessage"><?php echo $message;?></div>

						<?php echo form_open("auth/forgot_password");?>

						<p>
							<label for="email"><?php echo sprintf(lang('forgot_password_email_label'), $identity_label);?></label> <br />
							<?php echo form_input($email);?>
						</p>

						<p><?php echo form_submit('submit', lang('forgot_password_submit_btn'));?></p>

						<?php echo form_close();?>

					</div>
				</div>

			</div>


		</div>
	</div>
</div>