<?php
    $template = "default/";
    $url_template = Core::base_url()."app/view/".$template;
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>
<head>
<title>vnframework login</title>
<link href="<?php echo $url_template; ?>css/style.css" rel='stylesheet' type='text/css' />
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Church Sign In Form,Login Forms,Sign up Forms,Registration Forms,News latter Forms,Elements"./>
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
</script>
<!--webfonts-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
<!--//webfonts-->
</head>
<body>
	<h1>Church Sign In Form</h1>
		<div class="app-cross">
			<div class="cross"><img src="<?php echo $url_template; ?>images/cross.png" class="img-responsive" alt="" /></div>
			<h2>SIGN IN</h2>
			<form action="<?php echo Core::base_url()."user/checklogin"; ?>">
				<input type="text" name="user_name" class="text" value="E-mail address" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'E-mail address';}" >
				<input type="password" name="pass" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
				<div class="submit"><input type="submit" onclick="myFunction()" value="Sign in" ></div>
				<div class="clear"></div>
				<h3><a href="#">Forgot Password ?</a></h3>
			</form>
				<div class="buttons">
					<a href="#" class="hvr-shutter-in-vertical">Sign in with Twitter</a>
				</div>
					<h4>New here ? <a href="#"> Sign Up</a></h4>
			
		</div>
	<!--start-copyright-->
   		<div class="copy-right">
				<p>Copyright &copy; 2015  All rights  Reserved | Template by &nbsp;<a href="http://w3layouts.com">W3layouts</a></p>
		</div>
	<!--//end-copyright-->
</body>
</html>