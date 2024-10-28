<?php
require_once 'core/models.php';
require_once 'core/handleForms.php';

if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
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
		}

		input {
			font-size: 1.5em;
			height: 50px;
			width: 200px;
		}

		table,
		th,
		td {
			border: 1px solid black;
		}

		.backButton {
			position: fixed;
			top: 20px;
			bottom: 1000;
			z-index: 10000;
			/* Ensures the nav stays on top of other content */
			background-color: white;
			border: 1px solid;
			padding: 20px;
			margin-left: 10px;
			width: 60px;
			height: auto;
			box-shadow: 2px 2px;
			border-radius: 35px;
			text-align: center;
			text-decoration: none;
			/* Removes underline */
			color: inherit;
		}

		.main {
			background-color: white;
		}

		.mainInner {
			background-color: white;
			width: 30%;
			text-align: left;
			margin: 150px auto;
			padding: 30px;
			border-radius: 35px;
			box-shadow: 3px 3px;
			border: 1px solid;
		}
	</style>
</head>

<body>
	<a class="backButton" href="index.php" style="margin: 0px 10px 0px 10px">Back?</a>
	<?php $getUserByID = getUserByID($pdo, $_GET['user_id']); ?>
	<div clas="main">
		<div class="mainInner">
			<h1>Username: <span style="font-weight: normal"><?php echo $getUserByID['username']; ?></span></h1>
			<h1>Date Joined: <span style="font-weight: normal"><?php echo $getUserByID['date_added']; ?></span></h1>
			<h1>Password: <span style="font-weight: normal"><?php echo $getUserByID['password']; ?></span></h1>
		</div>
	</div>

</body>

</html>