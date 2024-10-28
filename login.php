<?php
require_once 'core/models.php';
require_once 'core/handleForms.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<style>
		body {
			font-family: "Arial";
			margin: 0 auto;
		}

		input {
			font-size: 1.5em;
			height: auto;
			width: auto;
		}

		table,
		th,
		td {
			border: 1px solid black;
		}

		.main {
			text-align: center;
			margin: 100px 150px 50px 150px;
			background-color: white;
			padding: 50px;
			border: 1px solid;
			box-shadow: 3px 3px;
			border-radius: 35px;
		}

		.mainInner {
			background-color: white;
			width: 30%;
			text-align: left;
			margin: 0 auto;
		}

		input[type="text"],
		input[type="password"] {
			width: 100%;
			box-sizing: border-box;
			text-align: left;
		}
	</style>
</head>

<body>
	<div class="main">
		<h1 style="margin-bottom: 10px;">Library Database</h1>
		<p style="font-size: 14px;">Only authorized personnel are allowed to access accounts.</p>
		<?php if (isset($_SESSION['message'])) { ?>
			<p style="color: red; font-size: 14px; text-align: center;"><i><?php echo $_SESSION['message']; ?></i></p>
		<?php }
		unset($_SESSION['message']); ?>
		<div class="mainInner">
			<form action="core/handleForms.php" method="POST">
				<p>
					<label style="font-weight: bold;" for="username">Username</label>
					<input type="text" name="username" required>
				</p>
				<p>
					<label style="font-weight: bold;" for="username">Password</label>
					<input type="password" name="password" required>
				</p>
				<p style="text-align: center;">
					<input style="font-size: 16px;" type="submit" name="loginUserBtn" value="Log in">
				</p>
			</form>
		</div>
		<p>Don't have an account? You may register <a href="register.php">here</a></p>
	</div>

</body>

</html>