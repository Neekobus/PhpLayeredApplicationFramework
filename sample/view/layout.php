<html>
	<head>
		<title><?php echo $data->get('title', 'untitled'); ?></title>
	</head>

	<body>

		<h1>I'm layout</h1>
		<div>
			<h2>This is child content</h2>
			<div>
				<?php echo $content; ?>
			</div>
		</div>
		
		<p><a href="dump.log" />Want to see the dump log of this page ?</a></p>

	</body>
</html>
