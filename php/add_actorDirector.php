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
				<form action="add_actorDirector.php" method="GET">
					Role: 	<input type="radio" name="whois" value="Actor"> Actor
							<input type="radio" name="whois" value="Director"> Director <br>
					First Name: <input type="text" name="first_name"><br>
					Last Name: 	<input type="text" name="last_name"><br>
					Gender: <input type="radio" name="gender" value="Female"> Female
							<input type="radio" name="gender" value="Male"> Male <br>
					Date of Birth (YYYY/MM/DD): <input type="text" cols="4" name="doby"> /
												<input type="text" cols="2" name="dobm"> /
												<input type="text" cols="2" name="dobd"><br>
					Date of Death (YYYY/MM/DD): <input type="text" cols="4" name="dody"> /
												<input type="text" cols="2" name="dodm"> /
												<input type="text" cols="2" name="dodd"><br>
												(Leave blank if still alive)<br>
					<input type="submit" value="Submit" />
				</form>
			</div>
		</div>
		
		<?php
		if ( !empty( $_GET['whois'])) 
		{
			$whois = $_GET['whois'];
			$first_name = $_GET['first_name'];
			$last_name = $_GET['last_name'];
			$gender = $_GET['gender'];
			$dob = $_GET['doby'] . $_GET['dobm'] . $_GET['dobd'];
			$dod = $_GET['dody'] . $_GET['dodm'] . $_GET['dodd'];

		    $db_connection = mysql_connect("localhost", "cs143", "");

		    if(!$db_connection) {
                $errmsg = mysql_error($db_connection);
                print "Connection failed: $errmsg <br />";
                exit(1);
            }

            mysql_select_db("CS143", $db_connection);

		    $id_query = 'SELECT id FROM MaxPersonID';
			$id_rs = mysql_query($id_query, $db_connection);
			$row = mysql_fetch_row($id_rs);
			$id = current($row) + 1;
			echo $id;
			mysql_free_result($id_rs);

			$query = "INSERT INTO " . $whois . " VALUES ($id, \"$last_name\", \"$first_name\", \"$gender\", $dob, $dod);";
						// $whois
						// # VALUES ($id,"$last_name", "$first_name", "$gender", $dob, $dod);
						// VALUES (69001, "Luna", "Gari", "Female", 20001231, 20981231)';

			mysql_query($query, $db_connection);

			$increment_query = "UPDATE MaxPersonID SET id=$id;"; // TACO write a query to increment max ID
			mysql_query($increment_query, $db_connection);
			
			mysql_close($db_connection);
        }
        	
		?>
	</body>
</html>