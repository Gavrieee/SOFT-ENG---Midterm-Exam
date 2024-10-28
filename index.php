<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<?php if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<style>
		body{
			font-family: Arial, sans-serif;
		}
		.inputForm {
			background-color: white;
			text-align: center; 
			margin: 100px 10px 100px 10px;
			padding: 5px;
			border: 10px black;
		}
		.studentForms {
			margin: 10px 50px 50px 50px;
			
			border: 10px black;
			background-color: white;
			display: flex;
			border-radius: 35px;
			border-style: outset;

			border: 1px solid;
			padding: 10px;
			box-shadow: 3px 3px;
			
			flex-wrap: wrap;
			display: flex;
			
			justify-content: center; /* Items are added from the top */
			align-items: center;
			
			overflow-x: auto; /* Allows scrolling if more items are added */
		}
		.container {
			border-style: solid;
			width: 200px;
			height: auto; /* Sets the fixed height */
			margin: 20px;
			padding: 10px 10px 0px 10px; /* Adjusted for space */
			border: 1px solid;
			box-shadow: 2px 2px;
			border-radius: 25px;
		}
		.inputInner {
			background-color: white;
			width: 20%;
  			margin: 0 auto;
			text-align: left;
		}
		input[type="text"], input[type="datetime-local"]{
			width: 100%; 
			box-sizing: border-box;	
			text-align: left;		
		}
		*{
			text-decoration: none;
		}
		.navBar {
			position: fixed;
			top: 0;
			z-index: 1000; /* Ensures the nav stays on top of other content */
			background-color: white;
			border: 1px solid;
			padding: 0px 30px 0px 30px;
			margin: 10px 0px 10px 0px;

			width: fixed;

			box-shadow: 2px 2px;
			border-radius: 35px;
			text-align: center;
		}
		.navdiv {
			display: flex;
			align-items: center;
			justify-content: space-between;
			
		}
		.username {
			font-size: 25px;
			font-weight: 600;
			color: black;
		}
		.navUserInner li {
			list-style: none;
			display: fixed;
		}
		li a{
			color: black;
			font-size: 18px;
			margin-right: 25px;
		}
		.navList button {
			background-color: white;
			margin: 0px 0px 0px 0px;
			border-radius: 0px;
			border-style: solid none;
			font-weight: bold;
			border-radius: 1px;
			border: 0px;
			font-size: 18px;
		}

		.navList button a{
			color: black;
		}

		.navUser {
			position: fixed;
			top: 120px;
			bottom: 1000;
			z-index: 10000; /* Ensures the nav stays on top of other content */
			background-color: white;
			border: 1px solid;
			padding: 0px 20px 0px 20px;
			margin: 0px;
			width: fixed;
			box-shadow: 3px 3px;
			border-radius: 35px;
			text-align: left;
		}

	</style>
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>

	<nav class="navBar">
		<div class="navdiv">
			<div class="username"><?php if (isset($_SESSION['username'])) { ?> <h3 style="font-weight: normal;"><b><?php echo $_SESSION['username']; ?></b></h3><?php } else { echo "<h1>No user logged in</h1>";}?></div>
			<ul>
				<div class="navList">
					<button><a href="core/handleForms.php?logoutAUser=1"><span style="font-weight: normal;">Logout</span></a></button>
				</div>
				
			</ul>
		</div>
	</nav>

	<nav class="navUser">
		<div class="navUserInner">
			<h3 style="text-align: center;">List of Users</h3>
			<ul>
				<?php $getAllUsers = getAllUsers($pdo); ?>
				<?php foreach ($getAllUsers as $row) { ?>
					<li>
						<a href="viewuser.php?user_id=<?php echo $row['user_id']; ?>"><?php echo $row['username']; ?></a>
					</li>
				<?php } ?>
			</ul>
		</div>
		
	</nav>

	<div class="inputForm">
		<h1>Library Rental System</h1>
		<p>Enter the student's credentials below.</p>
	<form action="core/handleForms.php" method="POST">
		<div class="inputInner">
			<p>
				<label for="fullname">Name</label> 
				<input type="text" name="fullname" required>
			</p>
			<p>
				<label for="fullname">Section</label> 
				<input type="text" name="section" pattern="[A-Za-z]{4} \d-\d" title="e.g., UCOS 3-2" required>
				</select>
			</p>
		
		</div>
		
		<p>
			<input type="submit" name="insertStudent">
		</p>
	</form>
	</div>
	<hr style="width: 90%;">
	<h1 style="text-align: center; margin-top: 50px;">Student Records</h1>
	<div class="studentForms">
		
		<?php $getAllWebDevs = getAllStudents($pdo); ?>
		<?php foreach ($getAllWebDevs as $row) { ?>
			<div class="container">
				<p><b>Name:</b> <?php echo $row['fullname']; ?></p>
				<p><b>Section:</b> <?php echo $row['section']; ?></p>
				<p><b>Registration Date:</b> <?php echo $row['registration_date']; ?></p>
				<p style="font-size: 12px;"><b>Recorded by: </b><?php echo $row['createdBy']; ?></p>
				<p style="font-size: 12px;"><b>Last updated by: </b><?php echo $row['updatedBy']; ?> at <?php echo $row['last_updated']; ?></p>
				<div class="editAndDelete" style="float: center; margin: 0px 20px 0px 20px;">
					<div style="text-align: center; margin-top: 20px;">
						<a href="viewRecords.php?student_id=<?php echo $row['student_id']; ?>" >View Records</a>
					</div>
					<p>
						<hr>
						<div style="display: flex;">
							<div style="flex: 1; padding: 0px 10px 0px 10px; text-align: left;">
								<a href="editStudent.php?student_id=<?php echo $row['student_id']; ?>">Edit</a>
							</div>
							<div style="flex: 1; padding: 0px 10px 0px 10px; text-align: right;">
								<a href="deleteStudent.php?student_id=<?php echo $row['student_id']; ?>">Delete</a>
							</div>
						</div>
					</p>
					
				</div>
			</div> 
		<?php } ?>
	</div>
	
</body>
</html>