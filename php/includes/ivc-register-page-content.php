<?php // This page is not in use. ?>
<h1> This is the content of the register page</h1>

<form name="registerform" id="registerform" action="http://127.0.0.1/wp-login.php?action=register" method="post">
	<p>
		<label for="user_login">Username<br />
		<input type="text" name="user_login" id="user_login" class="input" value="" size="20" /></label>
	</p>
	<p>
		<label for="user_email">E-mail<br />
		<input type="text" name="user_email" id="user_email" class="input" value="" size="25" /></label>
	</p>
		<p id="reg_passmail">A password will be e-mailed to you.</p>
	<br class="clear" />
	<input type="hidden" name="redirect_to" value="" />
	<p class="submit"><input type="submit" name="wp-submit" id="wp-submit" class="button button-primary button-large" value="Register" /></p>
</form>

