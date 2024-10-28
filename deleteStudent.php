<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		body{
			font-family: Arial, sans-serif;
		}
		.inputMain {
			background-color: white;
			text-align: center;
			margin: 100px 10px 100px 10px;
			
		}
		.container {
			border-style: solid;
			height: 100%;
			background-color: white;
			width: 50%;
  			margin: 0 auto;
			padding: 40px 30px 40px 30px;

			border: 2px solid red;

			box-shadow: 2px 2px red;
			border-radius: 25px;
		}
		.inputInner {
			padding: 0px 40px 0px 40px;
			background-color: white;
			text-align: left;
		}
		.backButton {
			position: fixed;
			top: 20px;
			bottom: 1000;
			z-index: 10000; /* Ensures the nav stays on top of other content */
			background-color: white;
			border: 1px solid;
			padding: 20px;
			margin-left: 10px;
			width: 60px;
			height: auto;
			box-shadow: 2px 2px;
			border-radius: 35px;
			text-align: center;
			text-decoration: none; /* Removes underline */
    		color: inherit;
		}
	</style>
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<a class="backButton" href="index.php" style="margin: 0px 10px 0px 10px">Back?</a>
	<div class="inputMain">
		<h1>Are you sure you want to <span style="color: red;">DELETE</span> this user?</h1>
		<?php $getWebDevByID = getStudentByID($pdo, $_GET['student_id']); ?>
		<div class="inputInner">
			<div class="container">
				<h3>Student Name: <span style="font-weight: normal"><?php echo $getWebDevByID['fullname']; ?></span></h3>
				<h3>Section: <span style="font-weight: normal"><?php echo $getWebDevByID['section']; ?></span></h3>
				<h3>Registration Date: <span style="font-weight: normal"><?php echo $getWebDevByID['registration_date']; ?></span></h3>
			</div>
			<div class="deleteBtn" style="margin: 20px; text-align: center;">
				<form action="core/handleForms.php?student_id=<?php echo $_GET['student_id']; ?>" method="POST">
					<input type="submit" name="deleteStudentBtn" value="Delete">
				</form>			
			</div>	
		</div>
		
	</div>
	
</body>
</html>
