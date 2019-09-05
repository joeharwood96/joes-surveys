<?php

// Things to notice:
// You need to add code to this script to implement the admin functions and features
// Notice that the code not only checks whether the user is logged in, but also whether they are the admin, before it displays the page content
// You can implement all the admin tools functionality from this script, or...

// execute the header script:
require_once "header.php";


if (!isset($_SESSION['loggedInSkeleton']))
{
	// user isn't logged in, display a message saying they must be:
	echo "You must be logged in to view this page.<br>";
}
else
{
	// only display the page content if this is the admin account (all other users get a "you don't have permission..." message):
	if ($_SESSION['username'] == "admin")
	{
        //Check if the delete button has been clicked 
        if(isset($_POST['delete1'])){
            
            $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
            //Create variables to store the information for the survey
            $username = $_POST['delete1'];
            $surveyTitle = $_POST['delete2'];
            //Delete the survey and its answers from the answers table
            $query = "DELETE FROM answers WHERE surveyID = (SELECT surveyID FROM surveys WHERE surveyTitle = '$surveyTitle' AND username = '$username');";

            $result = mysqli_query($connection, $query);
            //Delete the survey and its options from the options table
            $query = "DELETE FROM options WHERE surveyID = (SELECT surveyID FROM surveys WHERE surveyTitle = '$surveyTitle' AND username = '$username');";

            $result = mysqli_query($connection, $query);
            //Delete the survey and its questions from the questions table
            $query = "DELETE FROM questions WHERE surveyID = (SELECT surveyID FROM surveys WHERE surveyTitle = '$surveyTitle' AND username = '$username');";

            $result = mysqli_query($connection, $query); 
            //Delete the survey checking that the correct survey is being deleted 
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

        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        //Get the username from the session 
		$username = $_SESSION['username'];
        //Find the usernames and survey titles of the surveys with usernames that aren't admin
		$query = "SELECT username, surveyTitle FROM surveys WHERE username != '$username'";

    	// this query can return data ($result is an identifier):
    	$result = mysqli_query($connection, $query);

    	// how many rows came back?:
		$n = mysqli_num_rows($result);
		echo "<h2>Admin Tools</h2>";
		echo "<br>";
		echo "<table cellpadding='2' cellspacing='2' class='table'>";
        echo "<tr><th>Surveys</th><th>Username</th></tr>";
        // loop over all rows, adding them into the table:
        for ($i=0; $i<$n; $i++)
        {
			
            // fetch one row as an associative array (elements named after columns):
			$row = mysqli_fetch_assoc($result);
            $username = $row['username'];
            $surveyTitle = $row['surveyTitle'];
            // add it as a row in our table:
            echo "<tr>";
            echo "<td>{$surveyTitle}</td>";
            echo "<td>{$username}</td>";
            //Add buttons to update and delete surveys
            echo <<<_END
			<td>
				<a href="edit_survey.php?surveyTitle=$surveyTitle&user=$username" class="btn btn-warning">Update</a>
                <form action="" method="POST">
                    <input type="hidden" name="delete1" value="$username">
					<button type="submit" name="delete2" value="$surveyTitle" id="delete" class="btn btn-danger" onClick="showAlert(event)">Delete</button>
				</form>
			<td>
_END;
            echo "</tr>";
        }
        echo "</table>";
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
    //If the user is not admin they are unable to view this page
	else
	{
		echo "You don't have permission to view this page...<br>";
	}
}

// finish off the HTML for this page:
require_once "footer.php";
?>