<?php if(count($errors) > 0): ?>
	<div class="error">
		<?php foreach ($errors as $error): ?>
			<p style="color: red; text-align:center;"><strong><?php echo $error; ?></strong></p>
		<?php endforeach ?>
	</div>
<?php endif ?>