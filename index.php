<?php
	// main include
	require('main_include.php');

?>
<html>
	<head>
		<script src="./lib/jquery/jquery.min.js"></script>
		<script src="./lib/underscore/underscore-min.js"></script>
		<script src="./lib/bootstrap/dist/js/bootstrap.min.js"></script>
		<link href="./lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"></link>
	</head>
	<body>
		<h1>User: <?php echo($_SESSION['user_id'])?></h1>
		<a href="./logout.php">Logout</a>
	</body>
</html>