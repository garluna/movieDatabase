<!DOCTYPE html>
<html>
	<head>
		<title>CS143 Project 1B</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

	</head>

	<body>
		<h1>CS143 Project 1B: Movie Database</h1>
		<h3>Garima Lunawat and Katie Aspinwall</h3>

		<div class="row">
			<div class="col-md-4">
				<p>Add Actor / Director</p>
				<p>Add Movie Information</p>
				<p>Add Movie / Actor Relation</p>
				<p>Add Movie / Director Relation</p>
				<br>
				<p>Actor Information</p>
				<p>Movie Information</p>
				<br>
				<p>Search</p>
		
			</div> 

			<div class="col-md-8">
				<form action="add_movie.php" method="GET">
					Title: <input type="text" name="title"><br>
					Company: <input type="text" name="company"><br>
					Year: <input type="text" name="year"><br>
					MPAA Rating:	<input type="radio" name="rating" value="G"> G
									<input type="radio" name="rating" value="PG"> PG 
									<input type="radio" name="rating" value="PG-13"> PG-13 
									<input type="radio" name="rating" value="R"> R
									<input type="radio" name="rating" value="NC-17"> NC-17
									<input type="radio" name="rating" value="surrendere"> Surrendered<br>
					Genre : <input type="checkbox" name="genre[]" value="Action"> Action 
							<input type="checkbox" name="genre[]" value="Adult"> Adult 
							<input type="checkbox" name="genre[]" value="Adventure"> Adventure 
							<input type="checkbox" name="genre[]" value="Animation"> Animation 
							<input type="checkbox" name="genre[]" value="Comedy"> Comedy 
							<input type="checkbox" name="genre[]" value="Crime"> Crime 
							<input type="checkbox" name="genre[]" value="Documentary"> Documentary 
							<input type="checkbox" name="genre[]" value="Drama"> Drama 
							<input type="checkbox" name="genre[]" value="Family"> Family 
							<input type="checkbox" name="genre[]" value="Fantasy"> Fantasy 
							<input type="checkbox" name="genre[]" value="Horror"> Horror 
							<input type="checkbox" name="genre[]" value="Musical"> Musical 
							<input type="checkbox" name="genre[]" value="Mystery"> Mystery 
							<input type="checkbox" name="genre[]" value="Romance"> Romance 
							<input type="checkbox" name="genre[]" value="Sci-Fi"> Sci-Fi 
							<input type="checkbox" name="genre[]" value="Short"> Short 
							<input type="checkbox" name="genre[]" value="Thriller"> Thriller 
							<input type="checkbox" name="genre[]" value="War"> War 
							<input type="checkbox" name="genre[]" value="Western"> Western<br>
					<input type="submit" value="Submit" />
				</form>
			</div>
		</div>

		<?php
			if (!empty( $_GET['title'])) 
			{
				$title = $_GET['title'];
				$year = $_GET['year'];
				$company = $_GET['company'];
				$rating = $_GET['rating'];

			    $db_connection = mysql_connect("localhost", "cs143", "");

			    if(!$db_connection) {
	                $errmsg = mysql_error($db_connection);
	                print "Connection failed: $errmsg <br />";
	                exit(1);
	            }

	            mysql_select_db("CS143", $db_connection);

			    $id_query = 'SELECT id FROM MaxMovieID';
				$id_rs = mysql_query($id_query, $db_connection);
				$row = mysql_fetch_row($id_rs);
				$id = current($row) + 1;
				mysql_free_result($id_rs);

				$query = "INSERT INTO Movie VALUES ($id, \"$title\", \"$year\", \"$rating\", \"$company\");";
				mysql_query($query, $db_connection);

				// Insert genre(s) into MovieGenre table
				if(is_array($_GET['genre'])) {
				    foreach($_GET['genre'] as $genre) {
				        $add_genre_q = "INSERT INTO MovieGenre VALUES ($id, \"$genre\");";
				        mysql_query($add_genre_q, $db_connection);
				    }
				}

				// $query2 = "INSERT INTO MovieGenre VALUES ($id, \"$genre\");";
				// mysql_query($query2, $db_connection);

				$increment_query = "UPDATE MaxMovieID SET id=$id;";
				mysql_query($increment_query, $db_connection);
				
				mysql_close($db_connection);
	        }
		?>
	</body>
</html>