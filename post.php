#!/usr/local/bin/php
<?php
  header('Content-Type: text/plain charset=utf-8');

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	$posts = fopen('posts.txt', 'a');
	fwrite($posts, "<p><b>");
	//if author field is empty, default to username
	$author = $_POST['author'] ? $_POST['author'] : $_COOKIE['username'];
	fwrite($posts, $author);
	fwrite($posts, "</b> says: ");
	fwrite($posts, $_POST['content']);
	fwrite($posts, "</p>");
	fclose($posts);
	echo 'post successfully written'; 
  }

  if ($_SERVER['REQUEST_METHOD'] === 'GET') {
	echo 'Nobody has made a post.'; 
  }
?>