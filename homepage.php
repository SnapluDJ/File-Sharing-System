<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Homepage</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css" />
	</head>

	<body id="homepage">
		<?php
			session_start();
			$username = $_SESSION['usr'];
			echo "<h1>Hello, $username!</h1>";
		?>

		<p id="logout">
			<a href="logout.php">Logout</a>
		</p>

		<p>
			<a href="friendlist.php">My Friend List</a>
		</p>
		<br/>

		<form action="makefriend.php" method="POST">
			<label>Friend Someone! <input type="text" name="friend" placeholder="Type his name" /></label>
			<input type="submit" name="makefriend" value="Send Request" />
		</form>
		<br/>

		<form enctype="multipart/form-data" method="POST" action="upload.php">
			<p>
				<input type="hidden" name="MAX_FILE_SIZE" value="20000000" />
				<label>Choose a file to upload:<input type="file" name ="uploadedfile" /></label>
			</p>

			<input type="radio" name="authority" value="public" />Public
			<input type="radio" name="authority" value="private" />Private
			<input type="submit" name="fileuploaded" />
		</form>
		<br/>

		<?php
			//your private files
			echo "<p>Private Files List:</p>";
			$file_path = sprintf("/home/dongjielu/uploads/%s", $username);
			$files = scandir($file_path);
			$length = count($files);
			
			if ($length <= 2) {
				echo "<p>No file has been uploaded</p>";
			} else {
				echo "<ol>\n";
				for ($i=0; $i < $length; $i++) { 
					if ($files[$i] != "." && $files[$i] != "..") {
						printf('<li>
									<form action="viewfile.php" method="GET">
									  	  <input type="hidden" name="filename" value=%s />
									  	  <input type="hidden" name="directory" value="uploads" />
									  	  <label>%s<br/>
									  	  	<input type="submit" name="view" value="view" />
									  	  </label>
									</form>

									<form action="deletefile.php" method="GET">
									  	  <input type="hidden" name="filename" value=%s />
									  	  <input type="hidden" name="directory" value="uploads" />
									  	  <label><input type="submit" name="delete" value="delete" /></label>
									</form>	

									<form action="share.php" method="POST">
										<input type="hidden" name="filename" value=%s />
										<input type="hidden" name="directory" value="uploads" />
										<label><input type="text" name="friend" placeholder="Your Friend Name" /></label>
										<input type="submit" name="share" value="share" />
									</form>									
								</li>',
								htmlentities($files[$i]),
								htmlentities($files[$i]),
								htmlentities($files[$i]),
								htmlentities($files[$i])
						);
					}
				}
				echo "</ol>\n";
			}

			echo "<br/>";

			//your public files
			echo "<p>Public Files List:</p>";
			$file_path = sprintf("/home/dongjielu/publicfile/%s", $username);
			$files = scandir($file_path);
			$length = count($files);
			
			if ($length <= 2) {
				echo "<p>No file has been uploaded</p>";
			} else {
				echo "<ol>\n";
				for ($i=0; $i < $length; $i++) { 
					if ($files[$i] != "." && $files[$i] != "..") {
						printf('<li>
									<form action="viewfile.php" method="GET">
									  	  <input type="hidden" name="filename" value=%s />
									  	  <input type="hidden" name="directory" value="publicfile" />
									  	  <label>%s<br/>
									  	  	<input type="submit" name="view" value="view" />
									  	  </label>
									</form>

									<form action="deletefile.php" method="GET">
									  	  <input type="hidden" name="filename" value=%s />
									  	  <input type="hidden" name="directory" value="publicfile" />
									  	  <label><input type="submit" name="delete" value="delete" /></label>
									</form>	

									<form action="share.php" method="POST">
										<input type="hidden" name="filename" value=%s />
										<input type="hidden" name="directory" value="publicfile" />
										<label><input type="text" name="friend" placeholder="Your Friend Name" /></label>
										<input type="submit" name="share" value="share" />
									</form>									
								</li>',
								htmlentities($files[$i]),
								htmlentities($files[$i]),
								htmlentities($files[$i]),
								htmlentities($files[$i])
						);
					}
				}
				echo "</ol>\n";
			}

			echo "<br/>";

			//files that your friends give to you
			echo "<p>Files From Friends:</p>";
			$sharefile_path = sprintf("/home/dongjielu/share/%s", $username);
			$sharefiles = scandir($sharefile_path);
			$sharelength = count($sharefiles);
			
			if ($sharelength <= 2) {
				echo "<p>No file received</p>";
			} else {
				echo "<ol>\n";
				for ($i=0; $i < $sharelength; $i++) { 
					if ($sharefiles[$i] != "." && $sharefiles[$i] != "..") {
						printf('<li>
									<form action="viewfile.php" method="GET">										  	 
										<input type="hidden" name="filename" value=%s />
										<input type="hidden" name="directory" value="share" />
										<label>%s<br/>
											<input type="submit" name="view" value="view" />
										</label>
									</form>

									<form action="deletefile.php" method="GET">
									  	<input type="hidden" name="filename" value=%s />
									  	<input type="hidden" name="directory" value="share" />
									  	<label><input type="submit" name="delete" value="delete" /></label>
									</form>

									<form action="addtouploadfile.php" method="POST">
										<input type="hidden" name="filename" value=%s />
										<label><input type="submit" name="addtouploadfile" value="add to my file system" /></label>
									</form>										
								</li>',
								htmlentities($sharefiles[$i]),
								htmlentities($sharefiles[$i]),
								htmlentities($sharefiles[$i]),
								htmlentities($sharefiles[$i])
						);
					}
				}
				echo "</ol>\n";
			}
		?>
	</body>
</html>