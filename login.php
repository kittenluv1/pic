#!/usr/local/bin/php
<?php

  // SETTING UP OR RESUMING A SESSION
  session_save_path(__DIR__ . '/sessions/');
  session_name('myWebpage');
  session_start();

  $invalid_pass = false;
  if (isset($_POST['password'])) {
    validatePass($_POST['password'], $invalid_pass);
  }
  
  function validatePass($submit, &$invalid_pass) {
	//get hashed password
	$h_password = fopen('h_password.txt', 'r') or die('Unable to find the hashed password'); 
	$hashedPass = fgets($h_password); 
	$hashedPass = trim($hashedPass); 
	fclose($h_password); 
	//compare with hashed version of password submitted by user
	$hashedSubmit = hash('md2', $submit); 
	if ($hashedSubmit === $hashedPass) {
		$_SESSION['loggedin'] = true;
		$invalid_pass = false;
		header('Location: index.php'); 
		exit; 
	}
	else {
		$_SESSION['loggedin'] = false;
		$invalid_pass = true; 
	}
  }

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link rel="icon" href="https://www.ucla.edu/favicon.ico" type="image/x-icon">
	<link rel="stylesheet" href="style.css">
	<script src="username.js" defer></script>
	<script src="login.js" defer></script>
</head>

<body>
	<header>
		<h1>Welcome! Ready to check out my webpage?</h1>
	</header>
	<main>
		<section>
			<h2>Enter a username.</h2>
			<p>So that you can make your own posts and purchases, select a username and password.</p>
			<fieldset>
				<label>Username: <input id="username" type="text"></label>
				<br>
				<form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
					<label>Password: <input id="password" type="password" name="password"></label>
					<button type="submit" value="Login">Login</button>
				</form>
			</fieldset>
			<?php
				if ($invalid_pass) {
					echo '<p>Invalid password!</p>';
				}
			?>	
			<footer>
				<hr>
				<p>&copy; e****, 2024</p>
			</footer>
		</section>
	</main>
</body>

</html>