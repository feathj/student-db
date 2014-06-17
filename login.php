<?php
	// main include
	require('main_include.php');

	// login on post
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		// pull credentials from form
		$email = $_POST['email'];
		$password = $_POST['password'];

		// pull encrypted password and salt from db
		$stmt = $db->prepare('SELECT id,encrypted_password,salt FROM user WHERE email = ?');
		$stmt->bind_param('s', $email);
		$stmt->execute();
		$stmt->bind_result($id,$encrypted_password,$salt);
		$stmt->fetch();
		$stmt->close();

		// generate hashed password with salt
		$hashed = sha1($salt . $password);

		// do the hashes match? add user id to session and redirect.
		$failed = true;

		if($hashed === $encrypted_password){
			$_SESSION["user_id"] = $id;
			$_SESSION["email"] = $email;
			header('Location: ./index.php');
		} 
	}
?>
<html>
	<header>
		<link href="bower_components/bootstrap/dist/css/bootstrap.css" rel="stylesheet">
		<script type="text/javascript" src="bower_components/jquery/dist/jquery.js"></script>
		<script type="text/javascript">
		</script>
	</header>
	<body>

		<div class="container">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<div class="panel panel-default">
						<div class="panel-heading">
							<h3 class="panel-title">Please sign in</h3>
							<!-- show failed notification if signin failed -->
							<?php if($failed){ ?>
							<span>X Invalid email or password</span>
							<?php } ?>
						</div>
						<div class="panel-body">
							<form accept-charset="UTF-8" action="login.php" method="post">
								<fieldset>
									<div class="form-group">
										<input class="form-control" placeholder="E-mail" name="email" type="text">
									</div>
									<div class="form-group">
										<input class="form-control" placeholder="Password" name="password" type="password" value="">
									</div>
									<input class="btn btn-lg btn-success btn-block" type="submit" value="Login">
								</fieldset>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>

	</body>
</html>