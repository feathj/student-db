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
									<h3 class="panel-title">Admin Page - You're Special</h3>
								</div>
								<div class="panel-body">
									<h4>Create a New User</h4>
									<form name="createuser" action="" method="post">
										First Name: <input type="text" name="firstname"><br>
										Last Name: <input type="text" name="lastname"><br>
										E-mail: <input type="email" name="email"><br>
										Password: <input type="password" name="password"><br>
										<input type="submit" value="Submit">
									</form>
									<h4>Update an Existing User</h4>
									<form name="updateuser" action="" method="post">
										<select name="users">
											<?php
												//fetch possible list of users from db and display in dropdown menu
												$stmt = $db->prepare('SELECT id, first_name, last_name FROM user');
												$stmt->execute();
												$stmt->bind_result($id, $first_name, $last_name);
												while ($stmt->fetch()) {
													echo '<option value="' . $id . '">' . $first_name . ' ' . $last_name . '</option>';
												}
												$stmt->close();
											?>
										</select><br>
										First Name: <input type="text" name="firstname"><br>
										Last Name: <input type="text" name="lastname"><br>
										E-mail: <input type="email" name="email"><br>
										Password: <input type="password" name="password"><br>
										<input type="submit" value="Submit">
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>

			</body>
		</html>
		<?php
	}
	else {
		//display error message
		?>
		<p>You are not allowed to see this page.</p>
		<?php
	}
?>