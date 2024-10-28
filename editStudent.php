<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		body {
			font-family: Arial, sans-serif;
		}
		.inputMain {
			background-color: white;
			text-align: center;
			margin: 100px 10px 100px 10px;
		}
		.inputEditInner {
			background-color: white;
			width: 20%;
  			margin: 0 auto;
			text-align: left;
		}
		input[type="text"], input[type="datetime-local"]{
			width: 100%; 
			box-sizing: border-box;			
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
	<a class="backButton" href="index.php">Back?</a>
	<div class="inputMain">
		<?php $getWebDevByID = getStudentByID($pdo, $_GET['student_id']); ?>
		<h1>Edit Student Information</h1>
		<form action="core/handleForms.php?student_id=<?php echo $_GET['student_id']; ?>" method="POST">
			<div class="inputEditInner">
				<p>
					<label for="name">Student Name</label> 
					<input type="text" name="fullname" value="<?php echo $getWebDevByID['fullname']; ?>" required>
				</p>
				<p>
					<label for="name">Section</label> 
					<input type="text" name="section" value="<?php echo $getWebDevByID['section']; ?>" pattern="[A-Za-z]{4} \d-\d" title="e.g., UCOS 3-2" required>
				</p>
				<p>
					<label for="name">Registration Date</label> 
					<input type="datetime-local" name="registration_date" value="<?php echo $getWebDevByID['registration_date']; ?>" required>
				</p>
				
			</div>
		<p>
			<input type="submit" name="editStudentBtn">
		</p>	
		</form>
	</div>
</body>
</html>
