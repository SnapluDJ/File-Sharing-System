<!DOCTYPE html>
<html lang="en">
	<head>
		<title>File Sharing</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body id="friendlist">
		<?php
			session_start();

			$username = $_SESSION['usr'];
			$full_path = sprintf("/home/dongjielu/friends/$username/friendlist.txt");

			$h = fopen($full_path, "r");
			$linenum = 0;

			echo "<ul>\n";
			while (!feof($h)) {
				$temp = trim(fgets($h));
				if ($temp == '' && $linenum == 0) {
					echo "<h1>No friend yet...</h1>";
					break;
				} elseif ($temp == '') {
					break;
				}{
					printf("\t<li>
								<a href='friendhomepage.php?friendname=%s'>%s</a>
							</li>\n",
						htmlentities($temp),
						htmlentities($temp)
					);
					++$linenum;
				}
			}
			echo "</ul>\n";

			fclose($h);
		?>

		<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST">
			<label><input type="text" name="deletefriendname" placeholder="Type his name" /></label>
			<input type="submit" name= "submit" value="Delete Him" /> 
		</form>

		<p>
			<a id="friendlist_a" href="homepage.php">Homepage</a>
		</p>

		<?php
			//delete friend
			if (isset($_POST['submit'])) {
				
			
				$friendname = $_POST['deletefriendname'];

				$path = sprintf('/home/dongjielu/friends/%s/friendlist.txt', $username);
				$h = fopen($path, "r");	
				$find = false;

				while (!feof($h)) {
					$registeruser = trim(fgets($h));
					if ($friendname == $registeruser) {
						$find = true;
						break;
					}
				}
				fclose($h);

				if ($find == false) {
					printf('<br/>
							<p>
								Typo! Check again!
							</p>'
					);
				} else {
					$pathToMyFriendlist = sprintf("/home/dongjielu/friends/%s/friendlist.txt", $username);
					$pathToFriendFriendlist = sprintf("/home/dongjielu/friends/%s/friendlist.txt", $friendname);

					$lines1 = file($pathToMyFriendlist);
					foreach ($lines1 as $line1) {
						if (!strstr($line1, $friendname)) {
							$out1 .= $line1;
						}
					}

					$h1 = fopen($pathToMyFriendlist, "w");
					fwrite($h1, $out1);
					fclose($h1);

					$lines2 = file($pathToFriendFriendlist);
					foreach ($lines2 as $line2) {
						if (!strstr($line2, $username)) {
							$out2 .= $line2;
						}
					}
					$h2 = fopen($pathToFriendFriendlist, "w");
					fwrite($h2, $out2);
					fclose($h2);

					header("Location: friendlist.php");	
				}
			}
		?>
	</body>
</html>