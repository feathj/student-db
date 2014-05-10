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
									<h2 class="panel-title">Admin Page - You're Special</h2>
								</div>
								<div class="panel-body">
									<h3>Create a New User</h3>
									<form name="createuser" method="post">
										<table>
											<tr>
												<th>
													<label for="cfirstname">First Name:</label>
												</th>
												<td>
													<input type="text" name="cfirstname" id="cfirstname">
												</td>
											</tr>
											<tr>
												<th>
													<label for="clastname">Last Name:</label>
												</th>
												<td>
													<input type="text" name="clastname" id="clastname">
												</td>
											</tr>
											<tr>
												<th>
													<label for="cemail">E-mail:</label>
												</th>
												<td>
													<input type="email" name="cemail" id="cemail">
												</td>
											</tr>
											<tr>
												<th>
													<label for="cpassword">Password:</label>
												</th>
												<td>
													<input type="password" name="cpassword" id="cpassword">
												</td>
											</tr>
											<tr>
												<td>
													<input type="submit" value="Submit">
												</td>
											</tr>
										</table>
									</form>
									<h3>Update an Existing User</h3>
									<form name="updateuser" method="post">
										<table>
											<tr>
												<th>
													<label for="select">Select a user:</label>
												</th>
												<td>
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
													</select>
												</td>
											</tr>
											<tr>
												<th>
													<label for="firstname">First Name:</label>
												</th>
												<td>
													<input type="text" name="firstname" id="firstname">
												</td>
											</tr>
											<tr>
												<th>
													<label for="lastname">Last Name:</label>
												</th>
												<td>
													<input type="text" name="lastname" id="lastname">
												</td>
											</tr>
											<tr>
												<th>
													<label for="email">E-mail:</label>
												</th>
												<td>
													<input type="email" name="email" id="email">
												</td>
											</tr>
											<tr>
												<th>
													<label for="password">Password:</label>
												</th>
												<td>
													<input type="password" name="password" id="password">
												</td>
											</tr>
											<tr>
												<td>
													<input type="submit" value="Submit">
												</td>
											</tr>
										</table>
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