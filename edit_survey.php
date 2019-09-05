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
//Initialize variables
$message = "";
$question = "";
$questionType = "";
$surveyTitle = "";
$public = "";
$show_survey = "";
//Get the survey title from the url
$title = $_GET['surveyTitle'];


if (!isset($_SESSION['loggedInSkeleton']))
{
	// user isn't logged in, display a message saying they must be:
	echo "You must be logged in to view this page.<br>";
}
elseif (isset($_POST['delete1']))
{
	$username = $_SESSION['username'];
	// connect directly to our database (notice 4th argument) we need the connection for sanitisation:
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	// if the connection fails, we need to know, so allow this exit:
	if (!$connection)
	{
		die("Connection failed: " . $mysqli_connect_error);
	}
		
	$errors = "";
	//$errors = $email_val . $firstname_val . $lastname_val . $telephone_val;
	if ($errors == "")
	{
    
        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        //Get the survey title, username and question from the delete button
        $surveyTitle = $_POST['delete1'];
        $username = $_POST['delete2'];
        $question = $_POST['delete3'];
        //Delete the question from the answers table
        $query = "DELETE FROM answers WHERE surveyID = (SELECT surveyID FROM surveys WHERE surveyTitle = '$surveyTitle' AND username = '$username') AND username = '$username' AND questionID = (SELECT questionID FROM questions WHERE question = '$question' AND username= '$username');";                     
            
        $result = mysqli_query($connection, $query);  
        //Delete the question from the options table
        $query = "DELETE FROM options WHERE surveyID = (SELECT surveyID FROM surveys WHERE surveyTitle = '$surveyTitle' AND username = '$username') AND username = '$username' AND questionID = (SELECT questionID FROM questions WHERE question = '$question' AND username= '$username');";                     
            
        $result = mysqli_query($connection, $query); 
        //Delete the question from the questions table
        $query = "DELETE FROM questions WHERE surveyID = (SELECT surveyID FROM surveys WHERE surveyTitle = '$surveyTitle' AND username = '$username') AND username = '$username' AND question = '$question';";
        
        // this query can return data ($result is an identifier):
        $result = mysqli_query($connection, $query);
        
        if ($result) 
        {
            // show a successful update message:
            $show_survey = true;
            $message = "Question deleted<br>" ;
            echo "$message";
            // how many rows came back?:
		            
        } 
        else
        {
            // show an unsuccessful update message:
            $message = "Delete failed<br>";
        }
    
				
	}
	else
	{
		// validation failed, show the form again with guidance:
		$show_survey = true;
	}
		
	// we're finished with the database, close the connection:
	mysqli_close($connection);
	
}
else
{
    //First visit to the page
	$show_survey = true;
}
	
if ($show_survey)
{

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    //Get the username from the url:
	$username = $_GET['user'];
	//Select the questions from the survey that has been clicked on by the user
	$query = "SELECT question, questionType FROM questions WHERE surveyID = (SELECT surveyID FROM surveys WHERE surveyTitle = '$title' AND username = '$username');";

    // this query can return data ($result is an identifier):
    $result = mysqli_query($connection, $query);

    // how many rows came back?:
    $n = mysqli_num_rows($result);
    //Find wether or not the survey selected is public     
    $query2 = "SELECT public FROM surveys WHERE surveyTitle = '$title' AND username='$username';";

    $result2 = mysqli_query($connection, $query2);

    $row2 = mysqli_fetch_assoc($result2);
    //Set variable for wether the survey is public 
    $public = $row2['public'];

    echo "<h2>Survey</h2>";
	echo "Survey Title : {$title}<br></br>";
    echo "<table cellpadding='2' cellspacing='2' class='table'>";
    echo "<tr><th>Question Number</th><th>Question</th><th>Question Type</th></tr>";

	for ($i=1; $i<$n+1; $i++)
	{
		
		// fetch one row as an associative array (elements named after columns):
		$row = mysqli_fetch_assoc($result);
        $question = $row['question'];
        $questionType = $row['questionType'];
		// add it as a row in our table:
		
        echo "<tr>";
        echo "<td>{$i}</td>";
        echo "<td>{$question}</td>";
        echo "<td>{$questionType}</td>";
        //Add buttons to update and delete survey questions
        echo <<<_END
		<td>
			<a href="update_question.php?question=$question&questionType=$questionType&user=$username&surveyTitle=$title" class="btn btn-warning">Update</a>
			<form action="" method="POST">
                <input type="hidden" name="delete1" value="$title">
                <input type="hidden" name="delete2" value="$username">
				<button type="submit" name="delete3" value="$question" id="delete" class="btn btn-danger" onClick="showAlert(event)">Delete</button>
			</form>
		<td>
_END;
            echo "</tr>";
        }
        echo "<tr><th>Public</th></tr>";
        //If the survey is public show as yes
        if($public == 1){
        echo <<<_END
        <tr>
            <td>Yes</td>
            <td><a href="update_public.php?public=$public&surveyTitle=$title&user=$username" class="btn btn-warning">Update</a></td>
        </tr>
_END;
        } else {
        //If the survey is not public show as no
        echo <<<_END
        <tr>
            <td>No</td>
            <td><a href="update_public.php?public=$public&surveyTitle=$title&user=$username" class="btn btn-warning">Update</a></td>
        </tr> 
_END;
        }
        echo "</table>";
        //Button to delete survey questions
        echo "<a href='new_question.php?surveyTitle=$title&user=$username' class='btn btn-dark'>Add Question</a>";
        //Javascript that gives an alert asking if the user wants to delete a survey
        echo <<<_END
        <script>
        function showAlert(e) {
            var txt;
            var r = confirm("Are you sure you want to delete survey?");
            if (r == true) {
                txt = "You pressed OK!";
                return true;
            } else {
                txt = "You pressed Cancel!";
                e.preventDefault();
                return false;
            }
        }
        </script>

_END;
}

echo $message;

// finish off the HTML for this page:
require_once "footer.php";

?>