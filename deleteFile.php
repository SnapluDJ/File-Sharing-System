<!DOCTYPE html>
<html lang="en">
	<head>
		<title>File Sharing</title>
		<meta charset="utf-8" />
	</head>

	<body>
		<?php
			session_start();

			$directory = $_GET['directory'];
			$filename = $_GET['filename'];
			$username = $_SESSION['usr'];
			$full_path = sprintf('/home/dongjielu/%s/%s/%s', $directory, $username, $filename);

			if (unlink($full_path)) {
				header("Location: homepage.php");
				exit;
			} else {
				header("Location: deletefail.html");
				exit;
			}
		?>
	</body>
</html>