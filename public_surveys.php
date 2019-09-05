<?php

require_once "header.php";

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    //select the survey title and the usernames of the users who created the surveys
	$query = "SELECT surveyTitle, username FROM surveys WHERE public";

	// this query can return data ($result is an identifier):
	$result = mysqli_query($connection, $query);

	// how many rows came back?:
    $n = mysqli_num_rows($result);
	echo "<h2>Public Surveys</h2>";
	echo "<table cellpadding='2' cellspacing='2' class='table'>";
	echo "<tr><th class='thead-dark'>Survey Title</th><th>Username</th></tr>";
	// loop over all rows, adding them into the table:
	for ($i=0; $i<$n; $i++)
	{
			
		// fetch one row as an associative array (elements named after columns):
		$row = mysqli_fetch_assoc($result);
		$surveyTitle = $row['surveyTitle'];
		$username = $row['username'];
		// add it as a row in our table:
		echo "<tr>";
		echo "<td><a href=view_survey.php?surveyTitle=$surveyTitle&user=$username>{$surveyTitle}</a></td>";
		echo "<td>{$username}</td>";
		echo "</tr>";
	}
	echo "</table>";


require_once "footer.php";
?>