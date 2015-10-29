<!DOCTYPE html>
<html lang="en">
	<head>
		<title>File Sharing</title>
		<meta charset="utf-8" />
	</head>

	<body>
		<?php
			session_start();

			$username = $_SESSION['usr'];
			$filename = $_POST['filename'];
			$original_path = sprintf("/home/dongjielu/share/%s/%s", $username, $filename);
			$new_path = sprintf("/home/dongjielu/uploads/%s/%s", $username, $filename);

			rename($original_path, $new_path);
			
			header("Location: homepage.php");
		?>
	</body>
</html>