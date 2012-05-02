<html>
	<head>
		<title><?php echo $data->get('title', 'untitled'); ?></title>
	</head>

	<body>
		<p>Hello from the view ! The controller want to say : </p>
		<?php foreach ($data->get('message') as $message): ?>
			<li><?php echo $message; ?></li>
		<?php endforeach; ?>
		
		<p><a href="dump.log" />Want to see the dump log of this page ?</a></p>
	</body>
</html>
