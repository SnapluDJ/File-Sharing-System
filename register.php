<!DOCTYPE html>
<html lang="en">
	<head>
		<title>File Sharing</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<h1>Register</h1>
		<form id="register" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
			<p>
				<label>Username:<input type="text" name="usr" /></label>
			</p>

			<p>
				<label>Password:<input type="password" name="password" /></label>
			</p>

			<p>
				<input type="submit" name="submit"/>
				<input type="reset" />
			</p>
		</form>

		<?php
			if (isset($_POST['submit'])) {
				
				//check username and make sure it is alphanumeric with limited other characters
				$username = $_POST['usr'];
				if (!preg_match('/^[\w_\.\-]+$/', $username)) {
					echo "Invalid username";
					exit;
				}

				//check if this username already exits
				$validUsr = true;
				$h = fopen("../users.txt", "r");
			
				while (!feof($h)) {
					$registerUsr = trim(fgets($h));
					if ($username == $registerUsr) {
						$validUsr = false;
						break;
					}
				}
				fclose($h);

				if ($validUsr == false) {
					printf('<p class="invalid">	
								This username has already been registered, please change!
						    </p>'
					);
					exit;
				}

				session_start(); 
				$_SESSION['usr'] = $username;

				//write new user to users.txt
				$h1 = fopen("../users.txt", "a");
				fwrite($h1, "$username\n");
				fclose($h1);

				$user_path = sprintf('/home/dongjielu/uploads/%s', $username);
				$share_path = sprintf('/home/dongjielu/share/%s', $username);
				$friend_path = sprintf('/home/dongjielu/friends/%s', $username);
				$publicfile_pathe = sprintf('/home/dongjielu/publicfile/%s', $username);

				//make folders for new user
				mkdir($user_path);
				mkdir($share_path);
				mkdir($friend_path);
				mkdir($publicfile_pathe);

				//create a friendlist file for the new nuser
				fopen("/home/dongjielu/friends/$username/friendlist.txt", "w");

				header("Location: homepage.php");
			}
			
		?>
	</body>
</html>