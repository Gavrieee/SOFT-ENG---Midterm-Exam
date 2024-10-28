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
		.inputEditInner {
			background-color: white;
			width: 20%;
  			margin: 0 auto;
			text-align: left;
		}
		input[type="text"], input[type="date"]{
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
	<a class="backButton" href="viewRecords.php?student_id=<?php echo $_GET['student_id']; ?>">
	Back?</a>
	<div class="inputMain">
		<h1>Edit Mode</h1>
		<?php $getProjectByID = getBookByID($pdo, $_GET['book_id']); ?>

		<form action="core/handleForms.php?book_id=<?php echo $_GET['book_id']; ?> &student_id=<?php echo $_GET['student_id']; ?>" method="POST">
			<div class="inputEditInner">

			<?php
			if (!empty($getProjectByID['updatedBy'])) {
				echo '<h3 style="font-size: 14px;">Last updated by: <span style="font-weight: normal;">' 
				. htmlspecialchars($getProjectByID['updatedBy']) 
				. ' at ' . htmlspecialchars($getProjectByID['last_updated']) 
				. '</span></h3>';
			}?>

				<p>
					<label for="name">Book Title</label> 
					<input type="text" name="title" 
					value="<?php echo $getProjectByID['title']; ?>">
				</p>
				<p>
					<label for="name">Author</label> 
					<input type="text" name="author" 
					value="<?php echo $getProjectByID['author']; ?>">
				</p>
				<p>
					<label for="name">Genre</label> 
					<input type="text" name="genre" 
					value="<?php echo $getProjectByID['genre']; ?>">
				</p>
				<p>
					<label for="name">Publication Year</label> 
					<input type="date" name="publication_year" 
					value="<?php echo $getProjectByID['publication_year']; ?>">
				</p>
			</div>
			<p>
				<input type="submit" name="editBookBtn" style="text-align: center;">
			</p>
	</form>
	</div>
	
</body>
</html>
