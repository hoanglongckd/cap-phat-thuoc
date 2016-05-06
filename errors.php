<?php include 'header.php'; ?>
<?php include 'openBodyTag.php'; ?>
	<?php if ( !empty($error_messages) ) : ?>
		<ul>
			<?php foreach ($error_messages as $message) : ?>
				<li><?php echo $message; ?></li>
			<?php endforeach; ?>
		</ul>
	<?php else : ?>
		<h1>404 Not Found</h1>
	<?php endif; ?>

<?php include 'footer.php';?>