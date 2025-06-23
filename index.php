#!/usr/local/bin/php
<?php
	session_save_path(__DIR__ . '/sessions/');
	session_name('myWebpage');
	session_start();

	if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false || !isset($_COOKIE['username'])) {
		header('Location: login.php'); 
		exit; 
	}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>websiteee</title>
	<link rel="icon" href="https://www.pic.ucla.edu/~ericahuang916/images/flyingtoro.png" type="image/png">
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<header>
		<span id="greeting">
			<?php echo "Hello, {$_COOKIE['username']}!"; ?>
		</span>
		<nav>
			<ul>
				<li>index</li>
				<li><a href = "login.php">login</a></li>
				<li><a href = "blog.php">blog</a></li>
				<li><a href = "merch.php">merch</a></li>
			</ul>
		</nav>
		<h1>welcome to my website!</h1>
	</header>
	<main>
		<section>
			<h2>◝(˶˃ ᵕ ˂˶) ◜♡</h2>
			<p>blabla jksefijf lskdci</p>
			<ol>
				<li>one</li>
				<li>two</li>
				<li>threee</li>
			</ol>
			<img src="https://www.pic.ucla.edu/~ericahuang916/images/flyingtoro.png" alt="flyingtoro">
		</section>
		<section>
			<hr>
			<h2>Some recent posts by other users:</h2>
			<fieldset>
				<p>Post by user <b>malicious666</b>:</p>
				<p>Could anyone see how I can fix my
					<a href="scarf1.html" target="_blank"
						rel="opener">scarf</a>
					? Please help. I'm so sad. Here's a
					<a href="scarf2.html" target="_blank"
						rel="opener">picture</a>
					of the other side.
				</p>
			</fieldset>
		</section>
	</main>
	<footer>
		<hr>
		<p>&copy; e****, 2024</p>
	</footer>
</body>

</html>