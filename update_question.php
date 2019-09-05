<?php

require_once "header.php";
//Get the question and question type from the url:
$question = $_GET['question'];
$questionType = $_GET['questionType'];
$title = $_GET['surveyTitle'];

//Initialize variables
$updateQuestion = "";
$updateType = "";
$updateOption = "";
$show_question = "";
$message = "";
$username = "";

$question_val = "";



if (!isset($_SESSION['loggedInSkeleton']))
{
	// user isn't logged in, display a message saying they must be:
	echo "You must be logged in to view this page.<br>";
}
elseif (isset($_POST['question']))
{
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
                //Get the username from the url:
                $username = $_GET['user'];
                //update the option for each option given
                foreach ($_POST['option'] as $key => $updateOption) {
                    //Select the optionID of the options being passed into the specific question
                    $query = "SELECT optionID FROM options WHERE surveyID = (SELECT surveyID FROM surveys WHERE surveyTitle = '$title' AND username = '$username') 
                    AND questionID = (SELECT questionID FROM questions where question='$question' and username = '$username');";
                    $result = mysqli_query($connection, $query);
                    $row = mysqli_fetch_assoc($result);
                    //Get the questionID
                    $optionID = $row['optionID'];
                    //Increment each loop to the next questionID
                    $optionID = $optionID + $key;
                    //Update the options text
                    $query = "UPDATE options SET optionText = '$updateOption' WHERE optionID = $optionID;";
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

                
                echo "$message";
            }
        }

    //set the username variable to the username session
    $username = $_SESSION['username'];
	// connect directly to our database (notice 4th argument) we need the connection for sanitisation:
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	// if the connection fails, we need to know, so allow this exit:
	if (!$connection)
	{
		die("Connection failed: " . $mysqli_connect_error);
	}
		
	// SANITISATION CODE:
    $updateQuestion = sanitise($_POST['question'], $connection);
    $updateType = sanitise($_POST['type'], $connection);


	// SERVER-SIDE VALIDATION:
    $question_val = validateString($question, 1, 140);
    
	$errors = "";
	$errors = $question_val;
    if ($errors == "")
    {

        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        //set the username variable to the username session
		$username = $_SESSION['username'];
		//update the question
		$query = "UPDATE questions SET question = '$updateQuestion', questionType= '$updateType' WHERE question = '$question' AND username = '$username'";
		// this query can return data ($result is an identifier):
		$result = mysqli_query($connection, $query);

		// no data returned, we just test for true(success)/false(failure):
		if ($result) 
		{
			// show a successful signup message:
			$message = "Question saved<br>";
		} 
		else 
		{
			// show the form:
			$show_question = true;
			// show an unsuccessful signup message:
			$message = "Question failed, please try again<br>";
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
    //First visit to the update question page
	$show_question = true;
}  
//Show the update question form
if($show_question)
{
$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    
//set the username variable to the username url:
$username = $_GET['user'];
//Get the option text from the options table
$query = "SELECT optionText from options where surveyID = (select surveyID from surveys where surveyTitle ='$title' AND username ='$username') AND questionID = (SELECT questionID from questions where question = '$question' and username= '$username');";
// this query can return data ($result is an identifier):
$result = mysqli_query($connection, $query);

$n = mysqli_num_rows($result);
    
echo <<<_END
    <h2>Update Question</h2>  
    <div class="container">
    <form action="" method="POST" id="questions" class="form-group">
        <input type='text' name='question' placeholder='$question' class='form-control' required><br>
        Question type: <select name='type' class='form-control' id='exampleFormControlSelect1'>
_END;
        if($questionType == 'Drop-down'){
            echo <<<_END
            <option value="Drop-down" selected>Drop-down</option>
            <option value="Multiple choice">Multiple choice</option>
        </select> <br>
        Options:
_END;
        for($i=0; $i < $n; $i++){
            $row = mysqli_fetch_assoc($result);	
			$option = $row['optionText'];
            echo "<input type='text' name='option[$i]' placeholder='$option' class='form-control' required><br>";
        }
        echo <<<_END
        <input type="submit" value="Save" class="btn btn-dark">
    </form>
    </div>
_END;
            
        }
        elseif($questionType == 'Text'){
            echo <<<_END
            <option value="Drop-down">Drop-down</option>
            <option value="Text" selected>Text</option>
            <option value="Multiple choice">Multiple choice</option>
        </select> <br>
        <input type="submit" value="Save" class="btn btn-dark">
    </form>
    </div>
_END;
        }
        elseif($questionType == 'Multiple choice'){
            echo <<<_END
            <option value="Drop-down">Drop-down</option>
            <option value="Multiple choice" selected>Multiple choice</option>
        </select> <br>
        Options:
_END;
        for($i=0; $i < $n; $i++){
            $row = mysqli_fetch_assoc($result);	
			$option = $row['optionText'];
            echo "<input type='text' name='option[$i]' placeholder='$option' class='form-control' required><br>";
        }
        echo <<<_END
        <input type="submit" value="Save" class="btn btn-dark">
    </form>
    </div>
_END;
            
        }
       else {
           echo <<<_END
                <option disabled selected value>Select an option</option>
                <option value="Drop-down">Drop-down</option>
                <option value="Text">Text</option>
                <option value="Multiple choice">Multiple choice</option>
            </select> <br>
            <input type="submit" value="Save" class="btn btn-dark">
_END;
       } 
}

echo $message;

require_once "footer.php";

?>