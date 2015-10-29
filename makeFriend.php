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

			$username = $_SESSION['usr'];
			$friendname = $_POST['friend'];

			//can not make friends with yourself
			if ($username == $friendname) {
				echo "You can not make friends with yourself";
				printf('<p>
							<a href="homepage.php">Back to homepage</a>
						</p>'
				);
				exit;
			}

			//check if friendname exists
			$validUsr = false;
			$h1 = fopen("../users.txt", "r");
			
			while (!feof($h1)) {
				$registerUsr = trim(fgets($h1));
				if ($friendname == $registerUsr) {
					$validUsr = true;
					break;
				}
			}
			fclose($h1);

			if ($validUsr == false) {
				echo "This user do not exit! Please check again";
				printf('<p>
							<a href="homepage.php">Back to homepage</a>
						</p>'
				);
				exit;
			}

			//check if already be friends
			$alreadyFriends = false;
			$pathtofriend = sprintf("/home/dongjielu/friends/%s/friendlist.txt", $username);
			$h2 = fopen($pathtofriend, "r");

			while (!feof($h2)) {
				$friendlist = trim(fgets($h2));
				if ($friendname == $friendlist) {
					$alreadyFriends = true;
					break;
				}
			}
			fclose($h2);

			if ($alreadyFriends == true) {
				echo "You two are already friends...";
				printf('<p>
							<a href="homepage.php">Back to homepage</a>
						</p>'
				);
				exit;
			}

			//add usr to friend's friendlist
			$pathtousr = sprintf("/home/dongjielu/friends/%s/friendlist.txt", $friendname);
			$h3 = fopen($pathtousr, "a");
			fwrite($h3, "$username\n");
			fclose($h3);

			//add friend to usr's friendlist
			$h4 = fopen($pathtofriend, "a");
			fwrite($h4, "$friendname\n");
			fclose($h4);

			echo "Your two are friends now!";
		?>

		<p>
			<a href="homepage.php">Back to homepage</a>
		</p>
	</body>
</html>