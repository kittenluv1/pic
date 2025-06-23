#!/usr/local/bin/php
<?php
	header('Content-Type: text/plain; charset=utf-8');
	session_save_path(__DIR__ . '/sessions/');
	session_name('myWebpage');
	session_start();

	$db = new SQLite3('credit.db');
	$username = $_POST['username']; 
	$credit = (float) $_POST['credit'];
	$statement = "UPDATE users SET credit = $credit WHERE user = '$username'"; 
	@$db->exec($statement);
	$db->close(); 

?>
Either the user or credit was not posted. 