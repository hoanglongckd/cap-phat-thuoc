<?php 
	session_start();
	include 'ControllerSession.php';
	
	$cs = new Session();
	if ($cs->checkUserLogin())
		header("Location: dashboard.php");
	
	include 'header.php'; 
?>
<link rel="stylesheet" href="public/css/login.css" />
<?php include 'openBodyTag.php'; ?>

	<div class="login-page">
		<div class="form">
	    	<form action="ControllerLogin.php" method="post" class="login-form">
	      		<input type="text" name="username" placeholder="username"/>
	      		<input type="password" name="password" placeholder="password"/>
	      		<button>Login</button>
	    	</form>
	  	</div>
	</div>

<?php include 'footer.php'; ?>