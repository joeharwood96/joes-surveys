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
		//Check if the delete button has been pressed
		if(isset($_POST['delete'])){


			$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
			//Get the username from the delete form 
			$username = $_POST['delete'];
			//Delete user from answers table 
			$query = "DELETE FROM answers WHERE username = '$username'";

			$result = mysqli_query($connection, $query);
			//Delete user from options table
			$query = "DELETE FROM options WHERE username = '$username'";

			$result = mysqli_query($connection, $query);
			//Delete user from questions table
			$query = "DELETE FROM questions WHERE username = '$username'";

			$result = mysqli_query($connection, $query);
			//Delete user from surveys table
			$query = "DELETE FROM surveys WHERE username = '$username'";
			
			$result = mysqli_query($connection, $query);
			//Delete user from users table
            $query = "DELETE FROM users WHERE username = '$username';";
    
            // this query can return data ($result is an identifier):
            $result = mysqli_query($connection, $query);

            if ($result) 
            {
                // show a successful delete message:
                $message = "User deleted<br>" ;
                echo "$message";
            } 
            else
            {
                // show an unsuccessful delete message:
                $message = "Delete failed<br>";
                echo "$message";
            }
		}
		
		$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		//Get the user from the session
		$username = $_SESSION['username'];
		//Find the username, firstname, lastname from users where the user is not an admin 
		$query = "SELECT username, firstname, lastname FROM users WHERE username != '$username'";

    	// this query can return data ($result is an identifier):
    	$result = mysqli_query($connection, $query);

    	// how many rows came back?:
		$n = mysqli_num_rows($result);
		echo "<h2>Admin Tools</h2>";
		echo "<br>";
		echo "<table cellpadding='2' cellspacing='2' class='table'>";
        echo "<tr><th>Username</th><th>First Name</th><th>Last Name</th></tr>";
        // loop over all rows, adding them into the table:
        for ($i=0; $i<$n; $i++)
        {
			
            // fetch one row as an associative array (elements named after columns):
			$row = mysqli_fetch_assoc($result);
			$username = $row['username'];
			$firstname = $row['firstname'];
			$lastname = $row['lastname'];
            // add it as a row in our table:
            echo "<tr>";
			echo "<td>{$username}</td>";
			echo "<td>{$firstname}</td>";
			echo "<td>{$lastname}</td>";
			//Add buttons to update and delete users
			echo <<<_END
			<td>
				<a href="account.php?username=$username" class="btn btn-warning">Update</a>
				<form action="" method="POST">
					<button type="submit" name="delete" value="$username" id="delete" class="btn btn-danger" onClick="showAlert(event)">Delete</button>
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
            var r = confirm("Are you sure you want to delete user?");
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