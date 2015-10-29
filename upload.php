<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Upload</title>
		<meta charset="utf-8" />
	</head>

	<body>
		<?php
			session_start();

			//Get the filename and make sure it is valid
			$filename = basename($_FILES['uploadedfile']['name']);
			if (!preg_match('/^[\w_\.\-]+$/', $filename)) {
				echo "Invalid filename";
				exit;
			}

			//Get the username and make sure it is valid
			$username = $_SESSION['usr'];
			if (!preg_match('/^[\w_\.\-]+$/', $username)) {
				echo "Invalid username";
				exit;
			}
			
			//if authority is public, then move this file to publicfile folder otherwist to uploads folder
			$authority = $_POST['authority'];
			if ($authority == "public") {
				$publicfile_path = sprintf("/home/dongjielu/publicfile/%s/%s", $username, $filename);
				move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $publicfile_path);
			} else {
				$privatefile_path = sprintf("/home/dongjielu/uploads/%s/%s", $username, $filename);
				move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $privatefile_path);
			}

			header("Location: homepage.php");			
		?>
	</body>
</html>