<!DOCTYPE html>
<html>
<head>
	<title>Book Exchange</title>
	<!-- Add Bootstrap stylesheet -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		/* Style for the book image */
		.book-image {
			max-width: 150px;
			max-height: 150px;
			object-fit: cover;
			border: 1px solid #ddd;
			padding: 5px;
			margin: 5px;
			box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1 class="text-center">Book Exchange</h1>
			</div>
		</div>
		<?php
		// Connect to the database
		$servername = "localhost";
		$username = "username";
		$password = "";
		$dbname = "exchange_book_app";
		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// Query the database for posts
		$sql = "SELECT * FROM posts";
		$result = $conn->query($sql);

		// Loop through the results and display each post
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
				echo "<div class='row'>";
				echo "<div class='col-md-4'>";
				echo "<img class='book-image' src='" . $row["Images"] . "'>";
				echo "</div>";
				echo "<div class='col-md-8'>";
				echo "<h2>" . $row["title"] . "</h2>";
				echo "<p><strong>Author:</strong> " . $row["Name"] . "</p>";
				echo "<p><strong>Description:</strong> " . $row[""] . "</p>";
				echo "</div>";
				echo "</div>";
			}
		} else {
			echo "<div class='row'>";
			echo "<div class='col-md-12'>";
			echo "<p>No posts found.</p>";
			echo "</div>";
			echo "</div>";
		}

		// Close the database connection
		$conn->close();
		?>
	</div>
	<!-- Add Bootstrap JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>
</html>
