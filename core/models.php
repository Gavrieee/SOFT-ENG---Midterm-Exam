<?php

require_once 'dbConfig.php';

function insertNewUser($pdo, $username, $plain_password, $library_staff_id, $employment_type, $contact_number)
{

	$checkUserSql = "SELECT * FROM user_passwords WHERE username = ?";
	$checkUserSqlStmt = $pdo->prepare($checkUserSql);
	$checkUserSqlStmt->execute([$username]);

	if ($checkUserSqlStmt->rowCount() == 0) {

		$sql = "INSERT INTO user_passwords (username,password,library_staff_id,employment_type,contact_number) VALUES(?,?,?,?,?)";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$username, $plain_password, $library_staff_id, $employment_type, $contact_number]);

		if ($executeQuery) {
			return true;
		} else {
			$_SESSION['message'] = "An error occured from the query";
		}

	} else {
		$_SESSION['message'] = "User already exists!";
	}
}

function getHashedPasswordByUsername($pdo, $username)
{
	// Prepare the SQL statement to fetch the password
	$sql = "SELECT password FROM user_passwords WHERE username = ?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$username]);

	// Fetch and return the password hash, or return false if not found
	$row = $stmt->fetch(PDO::FETCH_ASSOC);
	return $row ? $row['password'] : false;
}

function loginUser($pdo, $username, $entered_password)
{

	$sql = "SELECT * FROM user_passwords WHERE username=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$username]);

	$hashed_password_from_db = getHashedPasswordByUsername($pdo, $username);

	if (/*$hashed_password_from_db */ $stmt->rowCount() == 1) {

		$userInfoRow = $stmt->fetch();
		$usernameFromDB = $userInfoRow['username'];
		$passwordFromDB = $userInfoRow['password'];

		/*Checks the hash of the entered password from Log In*/
		/*$ent_hashPass = password_hash($entered_password, PASSWORD_DEFAULT);
		*/
		if (/*password_verify($entered_password, $hashed_password_from_db)*/$entered_password == $passwordFromDB) {
			$_SESSION['username'] = $username;
			/*$_SESSION['message'] = "Login successful!";*/
			return true;
		} else {
			
			
			echo $_SESSION['message'] = "Hashed Entered Password:  = " . /*$ent_hashPass . */"\n Entered Password:" . $entered_password . "\nHashed Password from the DB: " . $hashed_password_from_db . " = " . $passwordFromDB;
			
			return false;
		}
	} else {
		$_SESSION['message'] = "error here";
	}

	if ($stmt->rowCount() == 0) {
		$_SESSION['message'] = "Username doesn't exist from the database!";
		return false;
	}

}

function getAllUsers($pdo)
{
	$sql = "SELECT * FROM user_passwords";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}

}

function getUserByID($pdo, $user_id)
{
	$sql = "SELECT * FROM user_passwords WHERE user_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$user_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}


function insertStudent($pdo, $fullname, $section, $createdbyUser)
{

	// Prepare the SQL with placeholders
	$sql = "INSERT INTO students (fullname, section, createdBy) VALUES (?, ?, ?)";
	$stmt = $pdo->prepare($sql);

	$executeQuery = $stmt->execute([$fullname, $section, $createdbyUser]);

	if ($executeQuery) {
		return true;
	}
}

function updateStudent($pdo, $fullname, $section, $registration_date, $updatedbyUser, $student_id)
{

	$sql = "UPDATE students
				SET fullname = ?,
					section = ?,
					registration_date = ?,
					updatedBy = ?
				WHERE student_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$fullname, $section, $registration_date, $updatedbyUser, $student_id]);

	if ($executeQuery) {
		return true;
	}

}


function deleteStudent($pdo, $student_id)
{
	$deleteWebDevProj = "DELETE FROM books WHERE student_id = ?";
	$deleteStmt = $pdo->prepare($deleteWebDevProj);
	$executeDeleteQuery = $deleteStmt->execute([$student_id]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM students WHERE student_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$student_id]);

		if ($executeQuery) {
			return true;
		}

	}

}

function getAllStudents($pdo)
{
	$sql = "SELECT * FROM students";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getStudentByID($pdo, $student_id)
{
	$sql = "SELECT * FROM students WHERE student_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$student_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function getBooksByStudent($pdo, $student_id)
{

	$sql = "SELECT 
				books.book_id AS book_id,
				books.title AS title,
				books.author AS author,
				books.genre AS genre,
				books.publication_year AS publication_year
			FROM books
			JOIN students ON books.student_id = students.student_id
			WHERE books.student_id = ? 
			GROUP BY books.title;
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$student_id]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}


function insertBook($pdo, $title, $author, $genre, $publication_year, $student_id)
{
	$sql = "INSERT INTO books (title, author, genre, publication_year, student_id) VALUES (?,?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$title, $author, $genre, $publication_year, $student_id]);
	if ($executeQuery) {
		return true;
	}

}

function getBookByID($pdo, $book_id)
{
	$sql = "SELECT 
				books.book_id AS book_id,
				books.title AS title,
				books.author AS author,
				books.genre AS genre,
				books.publication_year AS publication_year,
				books.updatedBy AS updatedBy,
				books.last_updated AS last_updated
			FROM books
			JOIN students ON books.student_id = students.student_id
			WHERE books.book_id  = ? 
			GROUP BY books.title";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$book_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function updateBook($pdo, $title, $author, $genre, $publication_year, $updatedbyUser, $last_updated, $book_id)
{
	$sql = "UPDATE books
			SET title = ?,
				author = ?,
				genre = ?,
				publication_year  = ?,
				updatedBy = ?,
				last_updated = ?
			WHERE book_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$title, $author, $genre, $publication_year, $updatedbyUser, $last_updated, $book_id]);

	if ($executeQuery) {
		return true;
	}
}

function deleteBook($pdo, $book_id)
{
	$sql = "DELETE FROM books WHERE book_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$book_id]);
	if ($executeQuery) {
		return true;
	}
}

function getAllInfoByStudentID($pdo, $student_id)
{
	$sql = "SELECT * FROM students WHERE student_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$student_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function getAllbookInfo($pdo, $book_id)
{
	$sql = "SELECT * FROM books WHERE book_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$book_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

?>
