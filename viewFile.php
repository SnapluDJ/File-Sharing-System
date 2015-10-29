<?php
	session_start();
	$directory = $_GET['directory'];
	$filename = $_GET['filename'];

	//check filename is in a valid format
	if (!preg_match('/^[\w_\.\-]+$/', $filename)) {
		echo "Invalid filename";
		exit;
	}

	//check username and make sure it is alphanumeric with limited other characters
	$username = $_SESSION['usr'];
	if (!preg_match('/^[\w_\.\-]+$/', $username)) {
		echo "Invalid username";
		exit;
	}

	$full_path = sprintf("/home/dongjielu/%s/%s/%s", $directory, $username, $filename);

	//get the MIME type
	$finfo = new finfo(FILEINFO_MIME_TYPE);
	$mime = $finfo->file($full_path);

	//set the Content-Type header and display
	header("Content-Type:".$mime);
	
	//clean the output buffer
	ob_clean();
	readfile($full_path);
?>
