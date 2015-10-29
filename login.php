<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Login</title>
		<meta charset="utf-8" />
		<link rel="stylesheet" type="text/css" href="style.css">
	</head>

	<body>
		<h1>Login</h1>
		<form id="login" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
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

	</body>

	<?php
		if (isset($_POST['submit'])) {
			$usrName = $_POST['usr'];
			$validUsr = false;

			$h = fopen("../users.txt", "r");

			if ($usrName == '') {
				echo "Invalid Username!";
				exit;
			}
 
			while( !feof($h) ){
				$registerUsr = trim(fgets($h));
				if ($usrName == $registerUsr) {
					$validUsr = true;
					break;
				}
			}
		
			if ($validUsr == true) {
				session_start();
				$_SESSION['usr'] = $usrName;
				header("Location: homepage.php");
				exit;
			} else {
				printf('<p class="invalid">	
							Invalid Username!
						</p>'
				);
			}

			fclose($h);
		}

	?>

</html>