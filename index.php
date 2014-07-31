<?php
	// main include
	require('main_include.php');
	require('main-nav.php');

	$user_id = $_SESSION['user_id'];

	$stmt = $db->prepare("SELECT first_name FROM user WHERE id = ?");
	$stmt->bind_param('i', $user_id);
	$stmt->execute();
	$stmt->bind_result($user_name);
	$stmt->fetch();
	$stmt->close();
?>
<html>
	<!--<head>
		<script src="./lib/jquery/jquery.min.js"></script>
		<script src="./lib/underscore/underscore-min.js"></script>
		<script src="./lib/bootstrap/dist/js/bootstrap.min.js"></script>
		<link href="./lib/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet"></link>
	</head>-->
	<body>
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-heading">
						<h2 class="panel-title">Hello <?php echo($user_name)?>!</h2>
					</div>
					<div class="panel-body">
						<p>Welcome! This is a sandbox site meant for teaching Tyler how to develop.</p>
						<p>Jon F. is the Web Sensei.</p>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>