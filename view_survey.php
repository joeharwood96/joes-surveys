<?php

// Things to notice:
// This is the page where each user can MANAGE their surveys
// As a suggestion, you may wish to consider using this page to LIST the surveys they have created
// Listing the available surveys for each user will probably involve accessing the contents of another TABLE in your database
// Give users options such as to CREATE a new survey, EDIT a survey, ANALYSE a survey, or DELETE a survey, might be a nice idea
// You will probably want to make some additional PHP scripts that let your users CREATE and EDIT surveys and the questions they contain
// REMEMBER: Your admin will want a slightly different view of this page so they can MANAGE all of the users' surveys

// execute the header script:
require_once "header.php";


//Get the survey title from the url:
$title = $_GET['surveyTitle'];
//Initialize variables
$answer = "";
$question = "";
$questionID = "";
$questionType = "";

$answer_val = "";

$show_survey = "";
$message = "";

if (!isset($_SESSION['loggedInSkeleton']))
{
	// user isn't logged in, display a message saying they must be:
	echo "You must be logged in to view this page.<br>";
}
//Chec if a answer has been given
elseif (isset($_POST['number']))
{
	//Set the username variable to the username session
	$username = $_SESSION['username'];
	// connect directly to our database (notice 4th argument) we need the connection for sanitisation:
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	// if the connection fails, we need to know, so allow this exit:
	if (!$connection)
	{
		die("Connection failed: " . $mysqli_connect_error);
	}
		
		$errors = "";
		if ($errors == "")
		{

			$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
			//Set the username variable to the username session
			$username = $_SESSION['username'];
			//For each answer given:
			foreach ($_POST['number'] as $key => $answer) {
				//select the question and questionID from the survey being answered
				$query = "SELECT question, questionID FROM questions WHERE surveyID = (SELECT surveyID FROM surveys WHERE surveyTitle = '$title' AND username = '$username');";
				$result = mysqli_query($connection, $query);
				$row = mysqli_fetch_assoc($result);
				//Get the questionID
				$questionID = $row['questionID'];
				//Increment each loop to the next questionID
				$questionID = $questionID + ($key - 1);
				//Insert; the answer, the username of who is answering, the questionID of the question being answered
				//and the surveyID of the survey being completed
				$query = "INSERT INTO answers (username, answer, questionID, surveyID) VALUES ('$username', '$answer', '$questionID', (SELECT surveyID FROM surveys WHERE surveyTitle = '$title' AND username = '$username'));";
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
				echo "$query";
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
		$username = $_GET['user'];
	
		$query = "SELECT question FROM questions WHERE surveyID = (SELECT surveyID FROM surveys WHERE surveyTitle = '$title' AND username = '$username');";

    	// this query can return data ($result is an identifier):
    	$result = mysqli_query($connection, $query);

    	// how many rows came back?:
		$n = mysqli_num_rows($result);

		$show_survey = true;
}
	
if ($show_survey)
{

	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	//Get the username from the url
	$username = $_GET['user'];
	//Select the questions from the survey being completed
	$queryQ = "SELECT question, questionType, questionID FROM questions WHERE surveyID = (SELECT surveyID FROM surveys WHERE surveyTitle = '$title' AND username = '$username');";

    // this query can return data ($result is an identifier):
    $resultQ = mysqli_query($connection, $queryQ);

    // how many rows came back?:
	$nQ = mysqli_num_rows($resultQ);


	echo <<<_END

	<h2>Survey Title: {$title}</h2><br>
	<div class="container">
	<form action="view_survey.php?surveyTitle=$title" method="POST" id="questions" class="form-group">
		
_END;
	//For each question echo out the question and a input form users to answer
	for ($i=1; $i<$nQ+1; $i++)
	{
		
		// fetch one row as an associative array (elements named after columns):
		$rowQ = mysqli_fetch_assoc($resultQ);
		$question = $rowQ['question'];
		$questionType = $rowQ['questionType'];
		$questionID = $rowQ['questionID'];
		//Get the optionText from options
		$queryO = "SELECT optionText FROM options WHERE questionID = $questionID;";

		// this query can return data ($result is an identifier):
		$resultO = mysqli_query($connection, $queryO);

		// how many rows came back?:
		$nO = mysqli_num_rows($resultO);

		// add it as a row in our table:
		echo "Question {$i}: <br> {$question}<br>";
		if($questionType == 'Text'){
			echo "Answer: <br> <input type='text' name='number[$i]' placeholder='Answer' class='form-control' required> <br>";
		}
		//If question type is drop-down give options 
		if($questionType == 'Drop-down'){
			echo "<select name='number[$i]' class='form-control' id='exampleFormControlSelect1'>";
			echo "<option disabled selected value> Select an option</option>";
			for($j= 0; $j < $nO; $j++){
			$rowO = mysqli_fetch_assoc($resultO);	
			$option = $rowO['optionText'];
			echo <<<_END
				<option value="$option">$option</option>
_END;
			}
			echo "</select> <br>";
		}
		//If question type is Multiple choice give options
		if($questionType == 'Multiple choice') {
			for($j= 0; $j < $nO; $j++){
			$rowO = mysqli_fetch_assoc($resultO);	
			$option = $rowO['optionText'];
			echo <<<_END
			$option <input type='radio' name='number[$i]' value='$option' required> <br>
_END;
			}
			echo "<br>";
		}
	}

		echo <<<_END

		<input type="submit" value="Submit" class="btn btn-dark">
	</form>
	</div>
_END;
	
}

echo $message;

// finish off the HTML for this page:
require_once "footer.php";

?>