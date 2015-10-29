<!DOCTYPE html>
<html lang="en">
	<head>
		<title>File Sharing</title>
		<meta charset="utf-8" />
	</head>

	<body>
		<?php
			session_start();

			$friendname = $_POST['friend'];
			$username = $_SESSION['usr'];
			$filename = $_POST['filename'];
			$directory = $_POST['directory'];

			//check if friendname exists
			$validUsr = false;
			$path = sprintf('/home/dongjielu/friends/%s/friendlist.txt', $username);
			$h = fopen($path, "r");
			
			while (!feof($h)) { 
				$registerUsr = trim(fgets($h));
				if ($friendname == $registerUsr) {
					$validUsr = true;
					break;
				}
			}
			fclose($h);

			if ($validUsr == false) {
				header("Location: sharefail.html");
				exit;
			}

			//copy file
			$source_path = sprintf("/home/dongjielu/%s/%s/%s", $directory, $username, $filename);
			$destiny_path = sprintf("/home/dongjielu/share/%s/%s", $friendname, $filename);
			copy($source_path, $destiny_path);
			
			header("Location: homepage.php");
		?>
	</body>
</html>