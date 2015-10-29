<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Logout</title>
		<meta charset="utf-8" />
	</head>

	<body>
		<?php
			session_start();
			session_destroy();
			clearstatcache();
			header("Location: index.html");
			exit;
		?>
	</body>
</html