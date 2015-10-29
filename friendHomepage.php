<!DOCTYPE html>
<html lang="en">
	<head>
		<title>File Sharing</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<?php
			session_start();
			$friendname = $_GET['friendname'];
			
			$file_path = sprintf("/home/dongjielu/uploads/%s", $friendname);
			$files
		?>
	</body>

	<p>
		<a href="homepage.php">Back to Homepage</a>
	</p>
</html>