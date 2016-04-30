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
		print '<h3>Show Actor Info</h3>';
		$actor_info_q = "SELECT first, last, sex, dob, dod FROM Actor WHERE id=$aid";

		$ainfo_rs = mysql_query($actor_info_q, $db_connection);
		$row = mysql_fetch_row($ainfo_rs);
		print "Name: " 			. $row['first'] . " " . $row['last'];
		print "Gender: " 		. $row['sex'];
		print "Date of Birth: " . $row['dob'];
		print "Date of Death: " . $row['dod'];
		mysql_free_result($id_rs);

		// Print films they've played a role in
		print '<h3>Filmography</h3>';
		$film_info_q = "SELECT role, title FROM MovieActor, Movie WHERE MovieActor.mid = Movie.id AND MovieActor.aid = $aid";
		$finfo_rs = mysql_query($film_info_q, $db_connection);

		while($row2 = mysql_fetch_array($finfo_rs))
		{
			print "Played role: " . $row2['role'] . "in: " . $row2['title']; 
		}
	}
?>