#!/usr/local/bin/php
<?php
	// open session
	session_save_path(__DIR__ . '/sessions/');
	session_name('myWebpage');
	session_start();

	if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false || !isset($_COOKIE['username'])) {
		header('Location: login.php'); 
		exit; 
	}

	//open database & create table
	$db = new SQLite3('credit.db'); 
	$statement = "CREATE TABLE IF NOT EXISTS users(user TEXT, credit REAL)";
	$db->exec($statement);
	//get info from table
	$statement = "SELECT user, credit FROM users WHERE user='{$_COOKIE['username']}'"; 
	$result = $db->query($statement); 
	if ($result) {
		if ($row = $result->fetchArray()) {
			$credit = $row['credit']; 
		} else {
			//if new user, insert into database and display credit of 20
			$statement = "INSERT INTO users (user, credit) VALUES ('{$_COOKIE['username']}', 20)";
			$db->exec($statement); 
			$credit = 20; 
		}
	}
	$db->close(); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Our Merchandise</title>
	<link rel="stylesheet" href="style.css">
	<script src="username.js" defer></script>
	<script src="merch.js" defer></script>
</head>

<body>
	<header>
		<nav>
			<ul>
				<li><a href = "index.php">index</a></li>
				<li><a href = "login.php">login</a></li>
				<li><a href = "blog.php">blog</a></li>
				<li>merch</li>
			</ul>
		</nav>
		<h1>Our Merchandise</h1>
	</header>
	<main>
		<section>
			<h2>choose your trinket ̗  ̗𖦹́ ̥𖦹̀ ̗  ̗:</h2>
			<p> please have a look around!!! new members are awarded with $20 !!! in store credit.
				you can increase your credits with a coupon code. when you want to make
				a purchase, select the checkboxes of the items you want and click the "Checkout" button below.
				enjoy your trinketing!
			</p>
			<p id="credit_para"> 
				Your credit: $<span id="credit"><?php echo number_format($credit, 2); ?></span>
			</p>
			<table>
				<tbody>
					<tr>
						<td>
							<img src="https://www.pic.ucla.edu/~ericahuang916/images/clover.png"
								alt="clover heart trinket">
							<h3>lucky charm</h3>
							<input type="checkbox">
							<span></span>
							<p>a lucky charm that will bring a spring to your step.</p>
						</td>
						<td>
							<img src="https://www.pic.ucla.edu/~ericahuang916/images/hello_kitty.png"
								alt="helly kitty cupcake">
							<h3>hello cupcake</h3>
							<input type="checkbox">
							<span></span>
							<p>a nostalgic character in a sweet new format!</p>
						</td>
						<td>
							<img src="https://www.pic.ucla.edu/~ericahuang916/images/egg.png"
								alt="egg shaped flower trinket">
							<h3>jelly-4-u</h3>
							<input type="checkbox">
							<span></span>
							<p>are you jelly for me too?</p>
						</td>
						<td>
							<img src="https://www.pic.ucla.edu/~ericahuang916/images/cake.png" alt="jelly cake trinket">
							<h3>love is in the air</h3>
							<input type="checkbox">
							<span></span>
							<p>share the love with a heart-shaped sweet treat. gift to your sweetheart or to
								yourself!</p>
						</td>
						<td>
							<img src="https://www.pic.ucla.edu/~ericahuang916/images/sanrio.png"
								alt="resin sanrio character">
							<h3>jelly melly</h3>
							<input type="checkbox">
							<span></span>
							<p>a deco trinket pal that you can carry in your pocket.</p>
						</td>
					</tr>
				</tbody>
			</table>
			<fieldset>
				<label>Coupon code: <input id="code" type="text"></label>
				<button value="checkout">Checkout</button>
				<p id="receipt"></p>
			</fieldset>
		</section>
	</main>
	<footer>
		<hr>
		<p>&copy; e****, 2024</p>
	</footer>
</body>

</html>