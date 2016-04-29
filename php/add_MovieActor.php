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
					Movie: 	<select name="movie">
								<?php
									$db_connection = mysql_connect("localhost", "cs143", "");

								    if(!$db_connection) {
						                $errmsg = mysql_error($db_connection);
						                print "Connection failed: $errmsg <br />";
						                exit(1);
						            }

						            mysql_select_db("CS143", $db_connection);

						            $getMovies = "SELECT title, mid from Movie ASC";
						            $rs = mysql_query($getMovies, $db_connection);

						            while($row = mysql_fetch_row($rs))
						            {
						            	$title = current($row);
						            	next($row);
						            	$mid = current($row);
						            	print '<option value="$mid">$title</option>';
						            }

						            mysql_free_result($rs);
						            mysql_close($db_connection);
								?>
							</select><br>
					Actor: 	<select name="actor">
								<option value="volvo">KT</option>
								<option value="saab">Garima</option>
							</select><br>
					Role: <input type="text" name="role"><br>
					<input type="submit" value="Submit" />
				</form>
			</div>
		</div>

		<?php
		if ( !empty( $_GET['title'])) 
		{
			$title = $_GET['title'];
			$year = $_GET['year'];
			$company = $_GET['company'];
			$rating = $_GET['rating'];
			$genre = $_GET['genre'];

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

			$query2 = "INSERT INTO MovieGenre VALUES ($id, \"$genre\");";
			mysql_query($query2, $db_connection);

			$increment_query = "UPDATE MaxMovieID SET id=$id;"; // TACO write a query to increment max ID
			mysql_query($increment_query, $db_connection);
			
			mysql_close($db_connection);
        }
        	
		?>
	</body>
</html>