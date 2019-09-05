<?php

require_once "header.php";
//initialize variables
$email = "";
$firstname = "";
$lastname = "";
$telephone = "";
$dob = "";

if (!isset($_SESSION['loggedInSkeleton']))
{
	// user isn't logged in, display a message saying they must be:
	echo "You must be logged in to view this page.<br>";
}
if(isset($_SESSION['username'])){

    //Check if the delete survey button has been clicked
    if(isset($_POST['delete1'])){
        //Get the survey title and username of the survey being deleted
        $surveyTitle = $_POST['delete2'];
        $username = $_POST['delete1'];

        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        //Delete the survey and its answers from the answers table
        $query = "DELETE FROM answers WHERE surveyID = (SELECT surveyID FROM surveys WHERE surveyTitle = '$surveyTitle' AND username = '$username');";

        $result = mysqli_query($connection, $query);
        //Delete the survey and its options from the options table
        $query = "DELETE FROM options WHERE surveyID = (SELECT surveyID FROM surveys WHERE surveyTitle = '$surveyTitle' AND username = '$username');";

        $result = mysqli_query($connection, $query);
        //Delete the survey and its questions from the questions table
        $query = "DELETE FROM questions WHERE surveyID = (SELECT surveyID FROM surveys WHERE surveyTitle = '$surveyTitle' AND username = '$username');";

        $result = mysqli_query($connection, $query);
        //Delete the survey from the surveys table
        $query = "DELETE FROM surveys WHERE surveyTitle = '$surveyTitle' AND username = '$username';";
        // this query can return data ($result is an identifier):
        $result = mysqli_query($connection, $query);
        if ($result) 
        {
            // show a successful update message:
            $message = "Survey deleted<br>" ;
            echo "$message";
        } 
        else
        {
            // show an unsuccessful update message:
            $message = "Delete failed<br>";
            echo "$message";
        }
    }
    //Set the username variable to the username session
    $username = $_SESSION["username"];
    //Get all of the user infromation of the user logged in from the user table 
    $query = "SELECT * FROM users WHERE username='$username'";
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	// this query can return data ($result is an identifier):
	$result = mysqli_query($connection, $query);
	
	// how many rows came back? (can only be 1 or 0 because username is the primary key in our table):
	$n = mysqli_num_rows($result);
		
	// if there was a match then extract their profile data:
    if ($n > 0)
    {
        // use the identifier to fetch one row as an associative array (elements named after columns):
        $row = mysqli_fetch_assoc($result);
        // extract their profile data for use in the HTML:
        $email = $row['email'];
        $firstname = $row['firstname'];
        $lastname = $row['lastname'];
        $dob = $row['dateofbirth'];
        $telephone = $row['telephone'];
    }
        
    mysqli_close($connection);

    echo <<<_END
    <h2>User Account</h2>

    <div class="card">
        <h1>$username</h1>
        Email: <p>$email</p>
        Firstname: <p>$firstname</p>
        lastname: <p>$lastname</p>
        D.O.B: <p>$dob</p>
        Telephone: <p>$telephone</p>
        <a href="account.php" class="btn btn-warning">Update</a>
    </div>

_END;

    $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
    //get the survey title and wether the survey is public from the surveys table 
	$query = "SELECT surveyTitle, public FROM surveys WHERE username = '$username'";

	// this query can return data ($result is an identifier):
	$result = mysqli_query($connection, $query);

	// how many rows came back?:
    $n = mysqli_num_rows($result);
    echo "<br>";
	echo "<h2>My Surveys</h2>";
	echo "<table cellpadding='2' cellspacing='2' class='table'>";
	echo "<tr><th class='thead-dark'>Survey Title</th><th>Public</th></tr>";
	// loop over all rows, adding them into the table:
	for ($i=0; $i<$n; $i++)
	{
			
		// fetch one row as an associative array (elements named after columns):
		$row = mysqli_fetch_assoc($result);
		$surveyTitle = $row['surveyTitle'];
        $public = $row['public'];
        
        if($public == 1){
            $public = "Yes";
        } else {
            $public = "No";
        }
		// add it as a row in our table:
		echo "<tr>";
		echo "<td><a href=view_survey.php?surveyTitle=$surveyTitle&user=$username>{$surveyTitle}</a></td>";
        echo "<td>{$public}</td>";
        //Add buttons to update and delete surveys
        echo <<<_END
			<td>
				<a href="edit_survey.php?surveyTitle=$surveyTitle&user=$username" class="btn btn-warning">Update</a>
                <form action="" method="POST">
                    <input type="hidden" name="delete1" value="$username">
					<button type="submit" name="delete2" value="$surveyTitle" id="delete" class="btn btn-danger" onClick="showAlert(event)">Delete</button>
				</form>
                <a href="results.php?surveyTitle=$surveyTitle" class="btn btn-success">Results</a>
			<td>
_END;
            echo "</tr>";
	}
    echo "</table>";
    //Javascript that gives an alert asking if the user wants to delete a survey
    echo <<<_END
        <a href="new_survey.php" class="btn btn-dark">Create Survey</a>
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

require_once "footer.php";

?>