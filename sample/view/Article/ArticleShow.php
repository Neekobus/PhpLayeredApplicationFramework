<html>
	<head>
		<title><?php echo $data->get('title', 'untitled'); ?></title>
	</head>

	<body>
		<p><?php print_r($data->get('article')); ?></p>
		<p><a href="dump.log" />Want to see the dump log of this page ?</a></p>
	</body>
</html>
