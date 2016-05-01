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
				<form action="add_rating.php" method="GET">
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
					?>
					
					Your Name: <input type="text" name="name"><br>
					Rating: <select name="rating">
						<option value='5'>5 - Excellent</option>
						<option value='4'>4 - Good</option>
						<option value='3'>3 - OK</option>
						<option value='2'>2 - Not worth it</option>
						<option value='1'>1 - Hate it</option>
					</select><br>
					Comments:<br>
					<textarea rows="4" cols="50" name="comments"></textarea><br><br>
					<input type="submit" value="Submit" />
				</form>
			</div>
		</div>
			<?php

				if ( !empty( $_GET['name'])) 
				{
					$mid = $_GET['mid'];
					$name = $_GET['name'];
					$rating = $_GET['rating']; // get integer value of rating
					$comments = $_GET['comments'];

				    $db_connection = mysql_connect("localhost", "cs143", "");

				    if(!$db_connection) {
		                $errmsg = mysql_error($db_connection);
		                print "Connection failed: $errmsg <br />";
		                exit(1);
		            }

		            mysql_select_db("CS143", $db_connection);

					$query = "INSERT INTO Review VALUES (\"$name\", CURRENT_TIMESTAMP(), $mid, $rating, \"$comments\");";

					if (!mysql_query($query, $db_connection))
					{
						print "Invalid SQL query: Cannot add Review <br />";
					}
					mysql_close($db_connection);
		        }
	        	
			?>
	</body>
</html>