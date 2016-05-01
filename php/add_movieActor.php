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
				<p><a href="add_actorDirector.php">Add Actor / Director</a></p>
				<p><a href="add_movie.php">Add Movie Information</a></p>
				<p><a href="add_movieActor.php">Add Movie / Actor Relation</a></p>
				<p><a href="add_movieDirector.php">Add Movie / Director Relation</a></p>
				<p><a href="add_rating.php">Add Rating</a></p>
				<br>
				<p><a href="show_actor.php">Actor Information</a></p>
				<p><a href="show_movie.php">Movie Information</a></p>
				<br>
				<p><a href="search.php">Search</a></p>
			</div> 

			<div class="col-md-8">
				<form action="add_movieActor.php" method="GET">
					<?php
						print "Movie: 	<select name=\"mid\">";
						$db_connection = mysql_connect("localhost", "cs143", "");

					    if(!$db_connection) {
			                $errmsg = mysql_error($db_connection);
			                print "Connection failed: $errmsg <br />";
			                exit(1);
			            }

			            mysql_select_db("CS143", $db_connection);

			            $getMovies = "SELECT title, id FROM Movie ORDER BY title ASC;";
			            $rs = mysql_query($getMovies, $db_connection);

			            while($row = mysql_fetch_array($rs))
			            {
			            	print "<option value='" . $row['id'] . "'>" . $row['title'] . " </option>";
			            }

			            mysql_free_result($rs);
			            mysql_close($db_connection);

			            print "</select><br>";

			            //Select Actors
			            print "Actor: 	<select name=\"aid\">";
						$db_connection = mysql_connect("localhost", "cs143", "");

					    if(!$db_connection) {
			                $errmsg = mysql_error($db_connection);
			                print "Connection failed: $errmsg <br />";
			                exit(1);
			            }

			            mysql_select_db("CS143", $db_connection);

			            $getMovies = "SELECT first, last, id FROM Actor ORDER BY first ASC;";
			            $rs = mysql_query($getMovies, $db_connection);

			            while($row = mysql_fetch_array($rs))
			            {
			            	print "<option value='" . $row['id'] . "'>" . $row['first'] . " " . $row['last'] . " </option>";
			            }

			            mysql_free_result($rs);
			            mysql_close($db_connection);

			            print "</select><br>";
					?>
					
					Role: <input type="text" name="role"><br>
					<input type="submit" value="Submit" />
				</form>
			</div>
		</div>
			<?php

				if ( !empty( $_GET['role'])) 
				{
					$role = $_GET['role'];
					$mid = $_GET['mid'];
					$aid = $_GET['aid'];

				    $db_connection = mysql_connect("localhost", "cs143", "");

				    if(!$db_connection) {
		                $errmsg = mysql_error($db_connection);
		                print "Connection failed: $errmsg <br />";
		                exit(1);
		            }

		            mysql_select_db("CS143", $db_connection);

					$query = "INSERT INTO MovieActor VALUES ($mid, $aid, \"$role\");";

					if (!mysql_query($query, $db_connection))
					{
						print "Invalid SQL query: Cannot add information into MovieActor";
					}

					mysql_close($db_connection);
		        }
	        	
			?>
	</body>
</html>
