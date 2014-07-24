
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>LoginDefault</title>
 	<link href="asset/css/style.css" rel="stylesheet">
 	<link href="modules/mod_jmlogin/asset/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
	<div id="jmdefault" class="jmlogin">
		<div class="jminner">
			<div class="jmuser_images"><span><i class="fa fa-user"></i></span></div>
			<form method="POST" id="login-form">
				<div class="pretext">
					<p>Pretext</p>
				</div>
				<div class="userdata">
					<div class="jmemail">
						<span><i class="fa fa-envelope"></i></span><input type="text" id="login_user_email" class="inputbox" name="useremail" placeholder="E-mail"/>
					</div>
					<div class="jmpassword"><span><i class="fa fa-lock"></i></span><input type="password" id="login_pass" class="inputbox" name="password" placeholder="Password"/></div>
					<div class="jm_remember">
						<p>Remember me <input id="modlgn-remember" type="checkbox" name="remember"  value="yes"/></p>
					</div>
					<div class="jmsubmit"><input type="submit" name="login" id="jm-login-btn" class="btn-jm-submit" value="Sign me in"/></div>
					
					<div class="jm-login-footer">
						<div class="jm-login-footer-left jmwidth">
							<a class="jm_new_account" href="#" data-tabid="#jmregister" data-tab="jmtab" data-toggle="jmmodal">New Account Singup?</a>
				            <a class="jm_forgot_password" href="#" data-tabid="#regain_password" data-tab="jmtab" data-toggle="jmmodal">Forgot your password?</a>
							 <a class="jm_forgot_password" href="#" data-tabid="#regain_password" data-tab="jmtab" data-toggle="jmmodal">Forgot your username?</a>
						 </div>
			            <div class="jmsocial jmwidth">Or connect width
							<ul>
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
	       		 	</div>
					
				</div>
				<div class="posttext">
					<p>Posttext</p>
				</div>
			</form>
		</div>
	</div>
</body>
</html>