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
		<div>
			<?php if (isset($_SESSION['flash-error'])) : ?>
				<div class="alert alert-<?php echo $_SESSION['flash-level']?>" >
					<p><?php echo $_SESSION['flash-error']; ?></p>
				</div>
			<?php 
				unset($_SESSION['flash-error']);
				unset($_SESSION['flash-level']);
				endif; 
			?>
		</div>
		<div class="form">
	    	<form action="ControllerLogin.php" method="post" class="login-form">
	      		<input type="text" name="username" placeholder="username" required />
	      		<input type="password" name="password" placeholder="password" required />
	      		<button>Login</button>
	    	</form>
	  	</div>
	</div>

<?php include 'footer.php'; ?>