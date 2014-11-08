
		<p>Hello from the view ! The controller want to say : </p>
		<?php foreach ($data->get('message') as $message): ?>
			<li><?php echo $message; ?></li>
		<?php endforeach; ?>
		
