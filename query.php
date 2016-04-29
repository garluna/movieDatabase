<!DOCTYPE html>
<html>
	<head>
		<title>CS143 Project 1A</title>
	</head>

	<body>
		<h1>CS143 Project 1A: Movie Database</h1>
		<h3>Garima Lunawat and Katie Aspinwall</h3>
		<p> Please enter a query to run on the Movies database here!</p>
		<p>
			<form action="query.php" method="GET">
				<textarea name="query" cols="60" rows="8"></textarea><br />
				<input type="submit" value="Submit" />
			</form>
		</p>

		<?php
		if ( !empty( $_GET['query'])) 
		{
		    $db_connection = mysql_connect("localhost", "cs143", "");
            if(!$db_connection) {
                $errmsg = mysql_error($db_connection);
                print "Connection failed: $errmsg <br />";
                exit(1);
            }

            mysql_select_db("CS143", $db_connection);
			$userQuery = $_GET["query"];
			$rs = mysql_query($userQuery, $db_connection);

			// Print query results in a table
			print '<table border="1" style="width:100%">';
			$i = 0;
			print '<tr>';
			while ($i < mysql_num_fields($rs))
			{
				$meta = mysql_fetch_field($rs, $i);
				print '<td><b>' . $meta->name . '</b></td>';
				$i++;
			}
			print '</tr>';

			while ($row = mysql_fetch_row($rs))
			{
				$i = 0;
				print '<tr>';
				
				while ($i < mysql_num_fields($rs))
				{
					$curr_data = current($row);
					print '<td>' . $curr_data .'</td>';
					next($row);
					$i++;
				}
				
				print '</tr>';
			}
			print '</table>';

			mysql_free_result($rs);
			mysql_close($db_connection);
        }
        	
		?>
	</body>
</html>