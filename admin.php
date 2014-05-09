<?php
	// main include
	require('main_include.php');

	//store the value of the "is_admin" field from the "user" table for the user in a variable
	$stmt = $db->prepare('SELECT is_admin FROM user WHERE id = ?');
	$stmt->bind_param('i', $_SESSION["user_id"]);
	$stmt->execute();
	$stmt->bind_result($is_admin);
	$stmt->fetch();
	$stmt->close();
	//check to see if the variable is true
	if ($is_admin) {
		//display the page
		?>
		<html>
			<header>
				<link href="./lib/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
				<script type="text/javascript" src="./lib/jquery/jquery.js"></script>
				<script type="text/javascript">
				</script>
			</header>
			<body>

				<div class="container">
					<div class="row">
						<div class="col-md-4 col-md-offset-4">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">Admin Page</h3>
								</div>
								<div class="panel-body">
									<p>Hello World!</p>
								</div>
							</div>
						</div>
					</div>
				</div>

			</body>
		</html>
		<?php
		//code that would allow them to create a user
		//code that would allow them to update an existing user (including their password)

	}
	else {
		//display error message
		?>
		<p>You are not allowed to see this page.</p>
		<?php
	}
?>