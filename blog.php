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
	<title>Our Posts</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<header>
		<nav>
			<ul>
				<li><a href = "index.php">index</a></li>
				<li><a href = "login.php">login</a></li>
				<li>blog</li>
				<li><a href = "merch.php">merch</a></li>
			</ul>
		</nav>
		<h1>Blog posts</h1>
	</header>
	<main>
		<fieldset>
			<form method="POST" action="post.php">
				<label for="author">Author:</label>
				<input id="author" type="text" name="author" value="<?php echo $_COOKIE['username']?>">
				<br>
				<label for="content">Content:</label>
				<textarea id="content" name="content"></textarea>
				<input type="submit" value="Post">
			</form>
		</fieldset>
		<section>
			<h2>Posts by other users:</h2>
			<?php
				$post = @fopen('posts.txt', 'r');
				if ($post) {
					while (!feof($post)) {
						$line = fgets($post);
						$characters = str_split($line); 
						for ($i = 0; $i < strlen($line); $i++) {
							if ($characters[$i] === " ") {
								//replace collapsible spaces with nbsp
								while ($characters[++$i] === " ")
									$characters[$i] = "&nbsp;"; 
							}
							if ($characters[$i] === "\n")
								$characters[$i] = "<br>"; 
						}
						$line = implode($characters); 
						echo $line; 
					}
					fclose($post);
				}
			?>
		</section>
	</main>
	<footer>
		<hr>
		<p>&copy; e****, 2024</p>
	</footer>
</body>

</html>