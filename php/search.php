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
				<form action="search.php" method="GET">
					Search: <input type="text" name="uinput"><br>
					<input type="submit" value="Search" />
				</form>

				<?php
					if (!empty( $_GET['uinput'])) 
					{
						$uinput = $_GET['uinput'];
						$uinput = trim(preg_replace('!\s+!', ' ', str_replace(array ("\r", "\t", "\n"), " ", $uinput)));
						$input_array = explode(" ", $uinput);

					    $db_connection = mysql_connect("localhost", "cs143", "");

					    if(!$db_connection) {
			                $errmsg = mysql_error($db_connection);
			                print "Connection failed: $errmsg <br />";
			                exit(1);
			            }

			            mysql_select_db("CS143", $db_connection);

			            // print matching actors
			            print "<h3>Matching Actors</h3><br>";
			            $actor_q = "SELECT first, last, id FROM Actor ORDER BY last;";
			            $actor_rs = mysql_query($actor_q, $db_connection);

			            if (!is_resource($actor_rs))
			            {
			            	print "Invalid SQL query: Cannot get information about Actor";
			            }
			            else
			            {
				            while($row = mysql_fetch_array($actor_rs))
				            {
				            	$to_print = true;

				            	foreach ($input_array as $word)
				            	{
				            		$fullname = " " . $row['first'] . " " . $row['last'];
			            			if (stripos($fullname, $word) == false)
			            			{
			            				$to_print = false;
			            				break;
			            			}
				            	}

				            	// print actor name if every user input word was found in their name
				            	if($to_print)
				            		print "Actor:<a href='show_actor.php?aid=" . $row['id'] . "'>" . $fullname . "</a><br>";
				            }
				        }

			            // print matching movies
			            print "<h3>Matching Movies</h3><br>";
			            $movie_q = "SELECT title, id from Movie ORDER BY title;";
			            $movie_rs = mysql_query($movie_q, $db_connection);

			            if(!is_resource($movie_rs))
			            {
			            	print "Invalid SQL query: Cannot get information about Movie";
			            }
			            else
			            {
				            while($row = mysql_fetch_array($movie_rs))
				            {
				            	$to_print = true;

				            	foreach ($input_array as $word)
				            	{
				            		if (stripos(" " . $row['title'], $word) == false) // if word is not in title
				            		{
				            			$to_print = false;
				            			break;
				            		}
				            	}

				            	// print movie name if every user input word was found in the title
				            	if($to_print)
				            		// print "Movie:" . $row['title'] . "<br>";
				            		print "Movie:<a href='show_movie.php?mid=" . $row['id'] . "'>" . $row['title'] . "</a><br>";
				            }
				        }

						mysql_free_result($actor_rs);
						mysql_free_result($movie_rs);
						
						mysql_close($db_connection);
			        }
				?>
			</div>
		</div>
	</body>
</html>