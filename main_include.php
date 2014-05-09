<?php

	error_reporting(E_ALL);
	session_start();
	# check if logged in, redirect if not
	$url_parts = explode('/',$_SERVER['REQUEST_URI']);
	$page = $url_parts[count($url_parts) - 1];
	if($page != 'login.php'){
		if(!isset($_SESSION['user_id'])){
			header('Location: ./login.php');
		}
	}
	 
	# connection to db
	require('config/development.php');
	$db = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
	
?>