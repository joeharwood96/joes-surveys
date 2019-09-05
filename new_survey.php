<?php

require_once "header.php";

//Initialize variables 
$title = "";
$public = "";
$question = "";

$title_val = "";
$public_val = "";
$show_survey = "";

$message = "";

if (!isset($_SESSION['loggedInSkeleton']))
{
	// user isn't logged in, display a message saying they must be:
	echo "You must be logged in to view this page.<br>";
}
//Check if the questions have been created
elseif (isset($_POST['number']))
{
    //Set the username from the username session
    $username = $_SESSION['username'];
    // connect directly to our database (notice 4th argument) we need the connection for sanitisation:
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	// if the connection fails, we need to know, so allow this exit:
	if (!$connection)
	{
		die("Connection failed: " . $mysqli_connect_error);
	}
		
	// SANITISATION CODE:
    $title = sanitise($_POST['surveyTitle'], $connection);
    $public = sanitise($_POST['public'],$connection);
    
	// SERVER-SIDE VALIDATION CODE MISSING:
		
	// ...
	$title_val = validateString($title, 1, 140);

    
	$errors = "";
    $errors = $title_val;
    
	if ($errors == "")
	{
        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        //Get the username from the url:
        $username = $_SESSION['username'];
        //Insert the new survey
		$query = "INSERT INTO surveys (surveyTitle, public, username) VALUES ('$title', $public, '$username');";
		// this query can return data ($result is an identifier):
		$result = mysqli_query($connection, $query);


        if ($result) 
		{
			// show a successful title saved message:
			$message = "Title saved<br>";
		} 
		else 
		{	
			// show an unsuccessful title saved message:
			$message = "Title failed, please try again<br>";
		}

        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        //Get the username from the session
		$username = $_SESSION['username'];
		//Select all the questions from the questions table
		$query = "SELECT question FROM questions;";
		// this query can return data ($result is an identifier):
		$result = mysqli_query($connection, $query);

		// how many rows came back?:
		$n = mysqli_num_rows($result);
        //for each question in the array insert the new question into the question table  
		foreach ($_POST['number'] as $i => $answer) {
                $question = $answer;
                $query = "INSERT INTO questions (question, questionType, username, surveyID) VALUES ('$question','Text','$username', (SELECT surveyID FROM surveys WHERE surveyTitle = '$title' AND username = '$username'));";
                $result = mysqli_query($connection, $query);
        
        }
        
		// no data returned, we just test for true(success)/false(failure):
		if ($result) 
		{
			// show a successful signup message:
			$message = "Survey saved<br>";
		} 
		else 
		{
			// show the form:
			$show_survey = true;
			// show an unsuccessful signup message:
			$message = "Survey failed, please try again<br>";
		}
				
	}
	else
	{
	    // validation failed, show the form again with guidance:
		$show_survey = true;
		// show an unsuccessful signin message:
		$message = "Survey failed, please check the errors shown above and try again<br>";
	}
		
	// we're finished with the database, close the connection:
	mysqli_close($connection);
}
else
{
		// just a normal visit to the page, show the survey form:
	
		$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		$username = $_SESSION['username'];
	
		$query = "SELECT question FROM questions;";

    	// this query can return data ($result is an identifier):
    	$result = mysqli_query($connection, $query);

    	// how many rows came back?:
		$n = mysqli_num_rows($result);

		$show_survey = true;
}
//Show the form for creating a new survey
if ($show_survey)
{
    echo "<h2>Create Survey</h2>";
    echo "<div class='container'>";
        echo "<form action='' method='post' class='form-group'>";
            echo "Survey Title: <input type='text' name='surveyTitle' placeholder='Enter a title' class='form-control' required> <br>";
    //show 5 new inputs for 5 new questions to be made with the survey
    for ($i=1; $i<6; $i++)
    {
        // fetch one row as an associative array (elements named after columns):
        // add it as a row in our table:
        echo "Question {$i}: <br> <input type='text' name='number[$i]' placeholder='Enter a question' class='form-control' required> <br>";
        
    }
            echo "Make public: <br>";
            echo "YES <input type='radio' id='contactChoice1' name='public' value=TRUE required> ";
            echo "NO <input type='radio' name='public' value=FALSE><br></br>";
            echo "<input type='submit' value='Submit' class='btn btn-dark'>";
        echo "</form>";
    echo "</div>";
}

echo $message;

require_once "footer.php";

?>