<?php

// Things to notice:
// This script is called by every other script (via require_once)
// It begins the HTML output, with the customary tags, that will produce each of the pages on the web site
// It starts the session and displays a different set of menu links depending on whether the user is logged in or not...
// ... And, if they are logged in, whether or not they are the admin
// It also reads in the credentials for our database connection from credentials.php

// database connection details:
require_once "credentials.php";

// our helper functions:
require_once "helper.php";

// start/restart the session:
session_start();

if (isset($_SESSION['loggedInSkeleton']))
{
	// THIS PERSON IS LOGGED IN
	// show the logged in menu options:

echo <<<_END
<!DOCTYPE html>
<html>
<header>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>		
	<script src="survey.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<title>A Survey Website</title>
</header>
<body>
<img id="logo" src="img/Logo.png" alt="logo">
<nav>
	<ul>
		<li><a href='about.php'>Home</a></li>
		<li><a href='view_account.php'>My Account</a></li>
		<li><a href='public_surveys.php'>Public Surveys</a></li>
		<li><a href='competitors.php'>Design and Analysis</a></li>
		<li><a href='sign_out.php'>Sign Out ({$_SESSION['username']})</a></li>
_END;
	// add an extra menu option if this was the admin:
	if ($_SESSION['username'] == "admin")
	{
		echo "<li><a href='admin.php'>Admin Tools</a></li>";
		echo "</ul>";
		echo "</nav>";
		echo "<br>";
	}
	else{
		echo "</ul>";
		echo "</nav>";
		echo "<br>";
	}
}
else
{
	// THIS PERSON IS NOT LOGGED IN
	// show the logged out menu options:
	
echo <<<_END
<!DOCTYPE html>
<html>
<header>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>		
	<script src="survey.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="style.css">
	<title>A Survey Website</title>
</header>
<body>
<img id="logo" src="img/Logo.png" alt="logo">
<nav>
	<ul>
		<li><a href='about.php'>Home</a></li> 
		<li><a href='public_surveys.php'>Public Surveys</a></li>
		<li><a href='sign_up.php'>Sign Up</a></li> 
		<li><a href='sign_in.php'>Sign In</a></li>
	</ul>
</nav>
_END;
echo "<br>";
}

?>