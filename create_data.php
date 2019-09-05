<?php

// Things to notice:
// This file is the first one we will run when we mark your submission
// Its job is to: 
// Create your database (currently called "skeleton", see credentials.php)... 
// Create all the tables you will need inside your database (currently it makes a simple "users" table, you will probably need more and will want to expand fields in the users table to meet the assignment specification)... 
// Create suitable test data for each of those tables 
// NOTE: this last one is VERY IMPORTANT - you need to include test data that enables the markers to test all of your site's functionality

// read in the details of our MySQL server:
require_once "credentials.php";

// We'll use the procedural (rather than object oriented) mysqli calls

// connect to the host:
$connection = mysqli_connect($dbhost, $dbuser, $dbpass);

// exit the script with a useful message if there was an error:
if (!$connection)
{
	die("Connection failed: " . $mysqli_connect_error);
}
  
// build a statement to create a new database:
$sql = "CREATE DATABASE IF NOT EXISTS " . $dbname;

// no data returned, we just test for true(success)/false(failure):
if (mysqli_query($connection, $sql)) 
{
	echo "Database created successfully, or already exists<br>";
} 
else
{
	die("Error creating database: " . mysqli_error($connection));
}

// connect to our database:
mysqli_select_db($connection, $dbname);

///////////////////////////////////////////
////////////// USERS TABLE //////////////
///////////////////////////////////////////

// if there's an old version of our table, then drop it:
$sql = "DROP TABLE IF EXISTS answers, options, questions, surveys, users";

// no data returned, we just test for true(success)/false(failure):
if (mysqli_query($connection, $sql)) 
{
	echo "Dropped existing table: users<br>";
} 
else 
{	
	die("Error checking for existing table: " . mysqli_error($connection));
}

// make our table:
$sql = "CREATE TABLE users (
			username VARCHAR(16) NOT NULL UNIQUE, 
			password VARCHAR(16), 
			firstname VARCHAR(32),
			lastname VARCHAR(64),
			telephone VARCHAR(16),
			dateofbirth VARCHAR(16),
			email VARCHAR(64), 
			PRIMARY KEY(username)
		);";

// no data returned, we just test for true(success)/false(failure):
if (mysqli_query($connection, $sql)) 
{
	echo "Table created successfully: users<br>";
}
else 
{
	die("Error creating table: " . mysqli_error($connection));
}

// put some data in our table:
$usernames[] = 'admin'; $passwords[] = 'secret'; $emails[] = 'admin@admin.com'; $firstname[] = 'Admin'; $lastname[] = 'Survey'; $dob[] = '1996-04-05'; $telephone[] = '07496355542'; 
$usernames[] = 'barrym'; $passwords[] = 'letmein'; $emails[] = 'barry@m-domain.com'; $firstname[] = 'Barry'; $lastname[] = 'Martin'; $dob[] = '1981-06-21'; $telephone[] = '07234244321'; 
$usernames[] = 'mandyb'; $passwords[] = 'abc123'; $emails[] = 'webmaster@mandy-g.co.uk'; $firstname[] = 'Mandy'; $lastname[] = 'Webster'; $dob[] = '1999-03-17'; $telephone[] = '07345589438'; 
$usernames[] = 'timmy'; $passwords[] = 'secret95'; $emails[] = 'timmy@lassie.com'; $firstname[] = 'Timmy'; $lastname[] = 'Lassie'; $dob[] = '1995-03-27'; $telephone[] = '07449278453'; 
$usernames[] = 'briang'; $passwords[] = 'password'; $emails[] = 'brian@quahog.gov'; $firstname[] = 'Brian'; $lastname[] = 'Quahog'; $dob[] = '2000-11-11'; $telephone[] = '07598453483'; 
$usernames[] = 'a'; $passwords[] = 'test'; $emails[] = 'a@alphabet.test.com'; $firstname[] = 'A'; $lastname[] = 'Test'; $dob[] = '1970-02-29'; $telephone[] = '07392489245'; 
$usernames[] = 'b'; $passwords[] = 'test'; $emails[] = 'b@alphabet.test.com'; $firstname[] = 'B'; $lastname[] = 'Test'; $dob[] = '1956-08-05'; $telephone[] = '07324902348'; 
$usernames[] = 'c'; $passwords[] = 'test'; $emails[] = 'c@alphabet.test.com'; $firstname[] = 'C'; $lastname[] = 'Test'; $dob[] = '1987-12-25'; $telephone[] = '07394857934'; 
$usernames[] = 'd'; $passwords[] = 'test'; $emails[] = 'd@alphabet.test.com'; $firstname[] = 'D'; $lastname[] = 'Test'; $dob[] = '2002-07-18'; $telephone[] = '07423953499'; 

// loop through the arrays above and add rows to the table:
for ($i=0; $i<count($usernames); $i++)
{
	$sql = "INSERT INTO users (username, password, email, firstname, lastname, dateofbirth, telephone) VALUES ('$usernames[$i]', '$passwords[$i]', '$emails[$i]', '$firstname[$i]', '$lastname[$i]', '$dob[$i]', '$telephone[$i]')";
	
	// no data returned, we just test for true(success)/false(failure):
	if (mysqli_query($connection, $sql)) 
	{
		echo "row inserted<br>";
	}
	else 
	{
		die("Error inserting row: " . mysqli_error($connection));
	}
}

///////////////////////////////////////////
////////////// SURVEYS TABLE //////////////
///////////////////////////////////////////

// if there's an old version of our table, then drop it:
	$sql = "DROP TABLE IF EXISTS surveys";

	// no data returned, we just test for true(success)/false(failure):
	if (mysqli_query($connection, $sql)) 
	{
		echo "Dropped existing table: surveys<br>";
	} 
	else 
	{	
		die("Error checking for existing table: " . mysqli_error($connection));
	}
	
	// make our table:
	$sql = "CREATE TABLE surveys (
				surveyID int NOT NULL UNIQUE AUTO_INCREMENT,
				surveyTitle VARCHAR(64),
				public Boolean,
				username VARCHAR(16), 
				FOREIGN KEY (username) REFERENCES users(username),
				PRIMARY KEY(surveyID)
			);";
	
	// no data returned, we just test for true(success)/false(failure):
	if (mysqli_query($connection, $sql)) 
	{
		echo "Table created successfully: surveys<br>";
	}
	else 
	{
		die("Error creating table: " . mysqli_error($connection));
	}
	
	// put some data in our table:
	$surveyTitle = array();
	$surveyTitle[]= 'Gaming'; $public[]= TRUE;
	$surveyTitle[]= 'Gaming'; $public[]= TRUE;
	$surveyTitle[]= 'Gaming'; $public[]= FALSE;
	$surveyTitle[]= 'Gaming'; $public[]= TRUE;
	$surveyTitle[]= 'Gaming'; $public[]= TRUE;
	$surveyTitle[]= 'Gaming'; $public[]= FALSE;
	$surveyTitle[]= 'Gaming'; $public[]= TRUE;
	$surveyTitle[]= 'Gaming'; $public[]= FALSE;
	$surveyTitle[]= 'Gaming'; $public[]= TRUE;
	
	// loop through the arrays above and add rows to the table:
	for ($i=0; $i<count($usernames); $i++)
	{
		$sql = "INSERT INTO surveys (surveyTitle, username, public) VALUES ('$surveyTitle[$i]', '$usernames[$i]', '$public[$i]')";
		
		// no data returned, we just test for true(success)/false(failure):
		if (mysqli_query($connection, $sql)) 
		{
			echo "row inserted<br>";
		}
		else 
		{
			die("Error inserting row: " . mysqli_error($connection));
		}
	}

///////////////////////////////////////////
////////////// QUESTION TABLE //////////////
///////////////////////////////////////////

// if there's an old version of our table, then drop it:
	$sql = "DROP TABLE IF EXISTS questions";

	// no data returned, we just test for true(success)/false(failure):
	if (mysqli_query($connection, $sql)) 
	{
		echo "Dropped existing table: questions<br>";
	} 
	else 
	{	
		die("Error checking for existing table: " . mysqli_error($connection));
	}
	
	// make our table:
	$sql = "CREATE TABLE questions (
				questionID int NOT NULL UNIQUE AUTO_INCREMENT, 
				question VARCHAR(140),
				questionType VARCHAR(16),
				username VARCHAR(16),
				surveyID int NOT NULL,
				FOREIGN KEY (username) REFERENCES users(username),
				FOREIGN KEY (surveyID) REFERENCES surveys(surveyID),
				PRIMARY KEY(questionID)
			);";
	
	// no data returned, we just test for true(success)/false(failure):
	if (mysqli_query($connection, $sql)) 
	{
		echo "Table created successfully: questions<br>";
	}
	else 
	{
		die("Error creating table: " . mysqli_error($connection));
	}
	
	// put some data in our table:
	$question = array();
	$question[]= 'What is your favourite console?'; $questionType[]= 'Drop-down';
	$question[]= 'What is your favourite game?'; $questionType[]= 'Text';
	$question[]= 'Number of hours spent gaming a week?'; $questionType[]= 'Multiple choice';
	$question[]= 'How old are you?'; $questionType[]= 'Text';
	$question[]= 'What is your home town?'; $questionType[]= 'Text';
	
	// loop through the username array and add rows to the table:
	for($j = 0; $j < count($usernames); $j++){
		//For each user add each question:
		for ($i=0; $i < count($question); $i++)
		{
			$sql = "INSERT INTO questions (question, questionType, username, surveyID) VALUES ('$question[$i]', '$questionType[$i]' , '$usernames[$j]', $j+1)";
			
			// no data returned, we just test for true(success)/false(failure):
			if (mysqli_query($connection, $sql)) 
			{
				echo "row inserted<br>";
			}
			else 
			{
				die("Error inserting row: " . mysqli_error($connection));
			}
		}
	}

///////////////////////////////////////////
////////////// OPTIONS TABLE //////////////
///////////////////////////////////////////

// if there's an old version of our table, then drop it:
	$sql = "DROP TABLE IF EXISTS options";

	// no data returned, we just test for true(success)/false(failure):
	if (mysqli_query($connection, $sql)) 
	{
		echo "Dropped existing table: options<br>";
	} 
	else 
	{	
		die("Error checking for existing table: " . mysqli_error($connection));
	}
	
	// make our table:
	$sql = "CREATE TABLE options (
				optionID int NOT NULL UNIQUE AUTO_INCREMENT,
				optionText VARCHAR(64), 
				questionID int,
				username VARCHAR(16),
				surveyID int,
				FOREIGN KEY (username) REFERENCES users(username),
				FOREIGN KEY (questionID) REFERENCES questions(questionID),
				FOREIGN KEY (surveyID) REFERENCES surveys(surveyID),
				PRIMARY KEY(optionID)
			);";
	
	// no data returned, we just test for true(success)/false(failure):
	if (mysqli_query($connection, $sql)) 
	{
		echo "Table created successfully: options<br>";
	}
	else 
	{
		die("Error creating table: " . mysqli_error($connection));
	}
	
	// put some data in our table:
	$option = array();
	$option[]= 'Xbox'; $questionID_option[]= 1;
	$option[]= 'PlayStation'; $questionID_option[]= 1;
	$option[]= 'Nintendo'; $questionID_option[]= 1;
	$option[]= '0-5'; $questionID_option[]= 3;
	$option[]= '6-10'; $questionID_option[]= 3;
	$option[]= '11-20'; $questionID_option[]= 3;
	// loop through the arrays above and add rows to the table:
	for ($j=0; $j<count($surveyTitle); $j++){
		//for each survey loop through the options
		for ($i=0; $i<count($option); $i++)
		{
			$sql = "INSERT INTO options (optionText, questionID, username, surveyID) VALUES ('$option[$i]', $questionID_option[$i], '$usernames[$j]', $j+1)";
			$questionID_option[$i] = $questionID_option[$i] + 5;
			// no data returned, we just test for true(success)/false(failure):
			if (mysqli_query($connection, $sql)) 
			{
				echo "row inserted<br>";
			}
			else 
			{
				die("Error inserting row: " . mysqli_error($connection));
			}
		}
		
	}

///////////////////////////////////////////
////////////// ANSWER TABLE //////////////
///////////////////////////////////////////

// if there's an old version of our table, then drop it:
	$sql = "DROP TABLE IF EXISTS answers";

	// no data returned, we just test for true(success)/false(failure):
	if (mysqli_query($connection, $sql)) 
	{
		echo "Dropped existing table: answers<br>";
	} 
	else 
	{	
		die("Error checking for existing table: " . mysqli_error($connection));
	}
	
	// make our table:
	$sql = "CREATE TABLE answers (
				answerID int NOT NULL UNIQUE AUTO_INCREMENT, 
				username VARCHAR(16),
				answer VARCHAR(140),
				questionID int,
				surveyID int,
				FOREIGN KEY (username) REFERENCES users(username),
				FOREIGN KEY (questionID) REFERENCES questions(questionID),
				FOREIGN KEY (surveyID) REFERENCES surveys(surveyID),
				PRIMARY KEY(answerID)
			);";
	
	// no data returned, we just test for true(success)/false(failure):
	if (mysqli_query($connection, $sql)) 
	{
		echo "Table created successfully: answers<br>";
	}
	else 
	{
		die("Error creating table: " . mysqli_error($connection));
	}
	
	// put some data in our table:
	$answer = array();
	$usernamesA[] = 'admin'; $questionID[]= '1'; $answer[]= 'Xbox';
	$usernamesA[] = 'admin'; $questionID[]= '2'; $answer[]= 'Fifa';
	$usernamesA[] = 'admin'; $questionID[]= '3'; $answer[]= '6-10';
	$usernamesA[] = 'admin'; $questionID[]= '4'; $answer[]= '22';
	$usernamesA[] = 'admin'; $questionID[]= '5'; $answer[]= 'Blackburn';
	$usernamesA[] = 'barrym'; $questionID[]= '6'; $answer[]= 'PlayStation';
	$usernamesA[] = 'barrym'; $questionID[]= '7'; $answer[]= 'Fifa';
	$usernamesA[] = 'barrym'; $questionID[]= '8'; $answer[]= '11-20';
	$usernamesA[] = 'barrym'; $questionID[]= '9'; $answer[]= '22';
	$usernamesA[] = 'barrym'; $questionID[]= '10'; $answer[]= 'Manchester';
	$usernamesA[] = 'mandyb'; $questionID[]= '11'; $answer[]= 'Nintendo';
	$usernamesA[] = 'mandyb'; $questionID[]= '12'; $answer[]= 'COD';
	$usernamesA[] = 'mandyb'; $questionID[]= '13'; $answer[]= '6-10';
	$usernamesA[] = 'mandyb'; $questionID[]= '14'; $answer[]= '22';
	$usernamesA[] = 'mandyb'; $questionID[]= '15'; $answer[]= 'Blackburn';
	$usernamesA[] = 'admin'; $questionID[]= '16'; $answer[]= 'Xbox';
	$usernamesA[] = 'admin'; $questionID[]= '17'; $answer[]= 'Fifa';
	$usernamesA[] = 'admin'; $questionID[]= '18'; $answer[]= '6-10';
	$usernamesA[] = 'admin'; $questionID[]= '19'; $answer[]= '22';
	$usernamesA[] = 'admin'; $questionID[]= '20'; $answer[]= 'Blackburn';
	$usernamesA[] = 'admin'; $questionID[]= '21'; $answer[]= 'Xbox';
	$usernamesA[] = 'admin'; $questionID[]= '22'; $answer[]= 'Fifa';
	$usernamesA[] = 'admin'; $questionID[]= '23'; $answer[]= '6-10';
	$usernamesA[] = 'admin'; $questionID[]= '24'; $answer[]= '22';
	$usernamesA[] = 'admin'; $questionID[]= '25'; $answer[]= 'Blackburn';
	$usernamesA[] = 'admin'; $questionID[]= '26'; $answer[]= 'Nintendo';
	$usernamesA[] = 'admin'; $questionID[]= '27'; $answer[]= 'Mario';
	$usernamesA[] = 'admin'; $questionID[]= '28'; $answer[]= '0-5';
	$usernamesA[] = 'admin'; $questionID[]= '29'; $answer[]= '15';
	$usernamesA[] = 'admin'; $questionID[]= '30'; $answer[]= 'Manchester';
	$usernamesA[] = 'admin'; $questionID[]= '31'; $answer[]= 'PlayStation';
	$usernamesA[] = 'admin'; $questionID[]= '32'; $answer[]= 'Fifa';
	$usernamesA[] = 'admin'; $questionID[]= '33'; $answer[]= '6-10';
	$usernamesA[] = 'admin'; $questionID[]= '34'; $answer[]= '30';
	$usernamesA[] = 'admin'; $questionID[]= '35'; $answer[]= 'London';
	$usernamesA[] = 'admin'; $questionID[]= '36'; $answer[]= 'Xbox';
	$usernamesA[] = 'admin'; $questionID[]= '37'; $answer[]= 'Fifa';
	$usernamesA[] = 'admin'; $questionID[]= '38'; $answer[]= '6-10';
	$usernamesA[] = 'admin'; $questionID[]= '39'; $answer[]= '30';
	$usernamesA[] = 'admin'; $questionID[]= '40'; $answer[]= 'Blackburn';
	$usernamesA[] = 'admin'; $questionID[]= '41'; $answer[]= 'Nintendo';
	$usernamesA[] = 'admin'; $questionID[]= '42'; $answer[]= 'Spyro';
	$usernamesA[] = 'admin'; $questionID[]= '43'; $answer[]= '11-20';
	$usernamesA[] = 'admin'; $questionID[]= '44'; $answer[]= '22';
	$usernamesA[] = 'admin'; $questionID[]= '45'; $answer[]= 'Liverpool';
	
	// loop through the arrays above and add rows to the table:
	for ($i=0; $i<count($answer); $i++)
	{
		$sql = "INSERT INTO answers (username, answer, questionID, surveyID) VALUES ('$usernamesA[$i]','$answer[$i]', '$questionID[$i]', 1)";
		
		// no data returned, we just test for true(success)/false(failure):
		if (mysqli_query($connection, $sql)) 
		{
			echo "row inserted<br>";
		}
		else 
		{
			die("Error inserting row: " . mysqli_error($connection));
		}
	}

// we're finished, close the connection:
mysqli_close($connection);
?>