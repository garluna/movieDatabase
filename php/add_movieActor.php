<!DOCTYPE html>
<html>
	<head>
		<title>CS143 Project 1B</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
		<link rel="stylesheet" href="style.css">
	</head>

	<body>
		<div class="page-header">
			<h1>CS143 Project 1B: Movie Database <small>Garima Lunawat and Katie Aspinwall</small></h1>
		</div>

		<div class="row">
			<div class="col-md-3">
				<ul class="nav nav-pills nav-stacked">
					<li><a href="search.php"><b>SEARCH</b></a></li>
				 	<li><a href="add_actorDirector.php"><b>ADD ACTOR/DIRECTOR</b></a></li>
					<li><a href="add_movie.php"><b>ADD MOVIE</b></a></li>
					<li><a href="add_movieActor.php"><b>ADD MOVIE/ACTOR RELATION</b></a></li>
					<li><a href="add_movieDirector.php"><b>ADD MOVIE/DIRECTOR RELATION</b></a></li>
					<li><a href="add_rating.php"><b>ADD RATING</b></a></li>
				</ul>
			</div> 

			<div class="col-md-9">
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
						else
						{
							print "<br> <b>Success!</b>";
						}

						mysql_close($db_connection);
			        }
		        	
				?>
			</div>
		</div>
	</body>
</html>
