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
					<?php
						include 'lookup.php';

						$db_connection = mysql_connect("localhost", "cs143", "");

					    if(!$db_connection) {
					    	echo "Hi";
			                $errmsg = mysql_error($db_connection);
			                print "Connection failed: $errmsg <br />";
			                exit(1);
			            }

			            mysql_select_db("CS143", $db_connection);

			            if (!empty($_GET['mid'])) // if mid passed by another page
			            	$minID = $_GET['mid'];
			            else // if no specified mid
			            {
			            	$id_query = "SELECT MIN(id) FROM Movie;";
							$id_rs = mysql_query($id_query, $db_connection);
							$row = mysql_fetch_assoc($id_rs);
							$minID = current($row);
			            }
			            
			            movieLookup($minID);
			            mysql_free_result($id_rs);
			            mysql_close($db_connection);
					?>
			</div>
		</div>
	</body>
</html>