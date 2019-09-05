<?php

require_once "header.php";
//Initialize variables
$question = "";
$questionID = "";
$surveyID = "";
$type = "";
$question_val = "";
$show_question = "";
$message = "";
//Get the survey title from the url
$title = $_GET['surveyTitle'];


if (!isset($_SESSION['loggedInSkeleton']))
{
	// user isn't logged in, display a message saying they must be:
	echo "You must be logged in to view this page.<br>";
}
//Check if a question has been saved
elseif (isset($_POST['question']))
{
    
    //Set variable to the username session
    $username = $_SESSION['username'];
	// connect directly to our database (notice 4th argument) we need the connection for sanitisation:
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	// if the connection fails, we need to know, so allow this exit:
	if (!$connection)
	{
		die("Connection failed: " . $mysqli_connect_error);
	}
		
	// SANITISATION CODE 
	$question = sanitise($_POST['question'], $connection);
    $type = sanitise($_POST['type'], $connection);

	// SERVER-SIDE VALIDATION
    $question_val = validateString($question, 1, 140);
    
	$errors = "";
	$errors = $question_val;
    if ($errors == "")
    {

        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		$username = $_SESSION['username'];
		
		$query = "INSERT INTO questions (question, questionType, username, surveyID) VALUES ('$question', '$type', '$username', (SELECT surveyID FROM surveys WHERE username = '$username' AND surveyTitle = '$title' ))";

		// this query can return data ($result is an identifier):
		$result = mysqli_query($connection, $query);

		// no data returned, we just test for true(success)/false(failure):
		if ($result) 
		{
			// show a successful question saved message:
            $message = "Question saved<br>";
            
		} 
		else 
		{
			// show the form:
			$show_question = true;
			// show an unsuccessful saved question message:
            $message = "Question failed, please try again<br>";
            
        }
        
        if(isset($_POST['option'])){
            // connect directly to our database (notice 4th argument) we need the connection for sanitisation:
            $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
            
            // if the connection fails, we need to know, so allow this exit:
            if (!$connection)
            {
                die("Connection failed: " . $mysqli_connect_error);
            }
                
            
            $errors = "";
            $errors = $question_val;
            if ($errors == "")
            {
               
                
                //update the option for each option given
                foreach ($_POST['option'] as $key => $updateOption) {
                    //Get the username from the url:
                    $username = $_GET['user'];
                    //Select the optionID of the options being passed into the specific question
                    $query = "SELECT questionID, surveyID FROM questions WHERE surveyID = (SELECT surveyID FROM surveys WHERE surveyTitle = '$title' AND username = '$username') AND question = '$question' and username = '$username';";
                    $result = mysqli_query($connection, $query);
                    $row = mysqli_fetch_assoc($result);
                    //Get the questionID and surveyID
                    $questionID = $row['questionID'];
                    $surveyID = $row['surveyID'];
                    
                    //Update the options text
                    $query = "INSERT INTO options (optionText, questionID, username, surveyID) VALUES ('$updateOption', '$questionID', '$username', '$surveyID');";
                    //echo "$query";
                    // this query can return data ($result is an identifier):
                    $result = mysqli_query($connection, $query);
                    // no data returned, we just test for true(success)/false(failure):
                    if ($result) 
                    {
                        // show a successful signup message:
                        $message = "Options saved<br>";
                    } 
                    else 
                    {
                        // show the form:
                        $show_question = true;
                        // show an unsuccessful signup message:
                        $message = "Option failed, please try again<br>";
                    }	
                }

            }
        }
				
	}
	else
	{
			// validation failed, show the form again with guidance:
			$show_question = true;
			// show an unsuccessful signin message:
			$message = "Survey failed, please check the errors shown above and try again<br>";
	}
		
		// we're finished with the database, close the connection:
		mysqli_close($connection);
}
else
{
    //First visit to new question page
	$show_question = true;
}  
//show the form for creating a new question
if($show_question)
{
    echo <<<_END
        <h2>New Question</h2>  
        <div class="container" id"optionContainer">
        <form action="" method="POST" id="optionQuestions" class="form-group">
            <input type='text' name='question' placeholder='Question' class='form-control' required><br>
            <select name='type' class='form-control' id='optionQuestion'>
                <option value="Drop-down">Drop-down</option>
                <option value="Text" selected>Text</option>
                <option value="Multiple choice">Multiple choice</option>
            </select> <br>
            <input type="submit" value="Save" class="btn btn-dark">
        </form>
        </div>
_END;
}
    
echo $message;

require_once "footer.php";

?>