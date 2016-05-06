<!-- Error Messages -->
<div class="col-lg-7">
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
<!-- /Error Messages -->
                    
                    
<!-- Flash Messages -->
<div class="col-lg-12">
	<?php if (isset($_SESSION['flash-message'])) : ?>
		<div class="alert alert-<?php echo $_SESSION['flash-level']?>" >
			<?php echo $_SESSION['flash-message']; ?>
		</div>
	<?php 
		unset($_SESSION['flash-message']);
		unset($_SESSION['flash-level']);
		endif; 
	?>
</div>
<!-- /Error Messages -->