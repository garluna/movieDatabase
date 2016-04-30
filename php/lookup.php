<?php
	function actorLookup($aid)
	{
		$db_connection = mysql_connect("localhost", "cs143", "");

	    if(!$db_connection) {
            $errmsg = mysql_error($db_connection);
            print "Connection failed: $errmsg <br />";
            exit(1);
        }

        mysql_select_db("CS143", $db_connection);

		// Print information about the actor/actress
		print '<h3>Actor Info</h3>';
		$actor_info_q = "SELECT first, last, sex, dob, dod FROM Actor WHERE id=$aid;";

		$ainfo_rs = mysql_query($actor_info_q, $db_connection);

		$row = mysql_fetch_assoc($ainfo_rs);
		// print_r($row);
		print "Name: " 			. $row['first'] . " " . $row['last'] . "<br>";
		print "Gender: " 		. $row['sex'] . "<br>";
		print "Date of Birth: " . $row['dob'] . "<br>";
		print "Date of Death: " . $row['dod'];
		mysql_free_result($ainfo_rs);

		// Print films they've played a role in
		print '<h3>Filmography</h3>';
		$film_info_q = "SELECT role, title FROM MovieActor, Movie WHERE MovieActor.mid = Movie.id AND MovieActor.aid = $aid";

		$finfo_rs = mysql_query($film_info_q, $db_connection);

		while($row2 = mysql_fetch_array($finfo_rs))
		{
			print "<b>Played role: </b>" . $row2['role'] . "<b> in: </b>" . $row2['title'] . "<br>"; 
		}

		mysql_free_result($finfo_rs);
		mysql_close($db_connection);
	}

	function movieLookup($mid)
	{
		$db_connection = mysql_connect("localhost", "cs143", "");

	    if(!$db_connection) {
            $errmsg = mysql_error($db_connection);
            print "Connection failed: $errmsg <br />";
            exit(1);
        }

        mysql_select_db("CS143", $db_connection);

		// Print information about the actor/actress
		print '<h3>Movie Info</h3>';
		$movie_info_q = "SELECT title, year, rating, company FROM Movie WHERE id=$mid;";
		$movie_genre_q = "SELECT genre FROM MovieGenre WHERE mid=$mid;";

		$minfo_rs = mysql_query($movie_info_q, $db_connection);
		$mgenre_rs = mysql_query($movie_genre_q, $db_connection);
	
		$row = mysql_fetch_assoc($minfo_rs);
		// print_r($row);
		print "Title: "		. $row['title'] . " (" . $row['year'] . ")<br>";
		print "Producer: " 	. $row['company'] . "<br>";
		print "Rating: " 	. $row['rating'] . "<br>";
		print "Genre: ";

		// $row2 = mysql_fetch_array($mgenre_rs);
		// print_r($row2);

		if ($row2 = mysql_fetch_array($mgenre_rs))
		{
			print $row2['genre'];
		}
		while ($row2 = mysql_fetch_array($mgenre_rs))
		{
			print ", " . $row2['genre'];
		}
		print "<br>";
		mysql_free_result($minfo_rs);
		mysql_free_result($mgenre_rs);

		// Print films they've played a role in
		print '<h3>Actors in the Movie</h3>';
		$actor_info_q = "SELECT first, last, role FROM MovieActor, Actor WHERE MovieActor.mid = $mid AND MovieActor.aid = Actor.id";

		$ainfo_rs = mysql_query($actor_info_q, $db_connection);

		while($row3 = mysql_fetch_array($ainfo_rs))
		{
			print "<b>Actor: </b>" . $row3['first'] . " ". $row3['last'] . "<b> as </b>" . $row3['role'] . "<br>"; 
		}

		mysql_free_result($ainfo_rs);

		print '<h3>Reviews</h3>';
		$avg_rating_q = "SELECT AVG(rating) FROM Review WHERE mid=$mid;";
		$review_q = "SELECT name, time, comment, rating FROM Review WHERE mid=$mid;";

		$rating_rs = mysql_query($avg_rating_q, $db_connection);
		$review_rs = mysql_query($review_q, $db_connection);

		$row4 = mysql_fetch_assoc($rating_rs);
		// print_r($row4);
		print "Average User Rating: " . $row4['AVG(rating)'] . "<br>";

		while ($row5 = mysql_fetch_array($review_rs))
		{
			// print_r($row5);
			print "<h4>\"" . $row5['comment'] . "\"</h4>";
			print "- " . $row5['name'] . ", " . $row5['time'] . ", Rating: " . $row5['rating'] . "<br>"; 
		}

		mysql_close($db_connection);
	}	
?>