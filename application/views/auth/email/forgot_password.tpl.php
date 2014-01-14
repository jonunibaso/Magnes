<html>
<body>
	<h1>The Magnes</h1>
	<p><?php echo sprintf(lang('email_forgot_password_heading'), $identity);?></p>
	<h2><?php echo sprintf(lang('email_forgot_password_subheading'), anchor('auth/reset_password/'. $forgotten_password_code, lang('email_forgot_password_link')));?></h2>
</body>
</html>