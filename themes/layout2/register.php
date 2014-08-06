<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
 	<title>RegisterDefault</title>
 	<link href="asset/css/style.css" rel="stylesheet">
 	<link href="asset/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
	<div id="jmregister" class="jmlayout2 jm_login">
		<div class="jminner">
			<div class="jmtitle">Register</div>
			<form method="POST" id="login-form">
				
				<div class="userdata">
					<div class="jmname input">
						<span><i class="fa fa-user"></i></span><input type="text" id="register_name" class="inputbox" name="name" placeholder="name"/>
					</div>
					<div class="jmusername input">
						<span><i class="fa fa-user"></i></span><input type="text" id="register_user_name" class="inputbox" name="userename" placeholder="username"/>
					</div>
					<div class="jmpassword input"><span><i class="fa fa-lock"></i></span><input type="password" id="register_pass" class="inputbox" name="password" placeholder="password"/></div>
					
					<div class="jmconfirmpassword input"><span><i class="fa fa-lock"></i></span><input type="password" id="register_confirm_pass" class="inputbox" name="password" placeholder="confirm password"/></div>
					<div class="jmemailaddress input"><span><i class="fa fa-envelope"></i></span><input type="password" id="register_email_address" class="inputbox" name="password" placeholder="email address"/></div>
					
					<div class="jmemailaddress input"><span><i class="fa fa-envelope"></i></span><input type="password" id="register_confirm_email_address" class="inputbox" name="password" placeholder="confirm email address"/></div>
					
				
					<div class="jmsubmit"><input type="submit" name="register" id="jm-register-btn" class="btn-jm-submit" value="Register"/></div>
					
				
				</div>
			
			</form>
		</div>
	</div>
</body>
</html>