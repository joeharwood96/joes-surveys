<?php

require_once "header.php";
//Get variables public and survey title from url:
$public = $_GET['public'];
$title = $_GET['surveyTitle'];
//initialize variables
$updatePublic = "";
$show_public = "";
$message = "";

if (!isset($_SESSION['loggedInSkeleton']))
{
	// user isn't logged in, display a message saying they must be:
	echo "You must be logged in to view this page.<br>";
}
//If user has saved updated public 
elseif (isset($_POST['public']))
{
    //Set username to session username
    $username = $_SESSION['username'];
	// connect directly to our database (notice 4th argument) we need the connection for sanitisation:
	$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
	
	// if the connection fails, we need to know, so allow this exit:
	if (!$connection)
	{
		die("Connection failed: " . $mysqli_connect_error);
	}
		
	// SANITISATION CODE:
		
    $updatePublic = sanitise($_POST['public'], $connection);
    
    // SERVER-SIDE VALIDATION:

    
	$errors = "";
    if ($errors == "")
    {
        $connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
        //Get username from the url:
		$username = $_GET['user'];
		//Update the public coloumn in the correct survey
		$query = "UPDATE surveys SET public = $updatePublic WHERE surveyTitle = '$title' AND username = '$username'";
		// this query can return data ($result is an identifier):
		$result = mysqli_query($connection, $query);

		// no data returned, we just test for true(success)/false(failure):
		if ($result) 
		{
			// show a successful signup message:
			$message = "Public saved<br>";
		} 
		else 
		{
			// show the form:
			$show_public = true;
			// show an unsuccessful signup message:
			$message = "Public failed, please try again<br>";
		}
				
	}
	else
	{
			// validation failed, show the form again with guidance:
			$show_public = true;
			// show an unsuccessful signin message:
			$message = "Survey failed, please check the errors shown above and try again<br>";
	}
		
		// we're finished with the database, close the connection:
		mysqli_close($connection);
}
else
{
    //First visit to the update public page
	$show_public = true;
}  

    if($show_public)
    {
    //if the survey is public check the yes box
    if($public == 1){
    echo <<<_END
        <h2>Update Public</h2>  
        <div class="container">
        <form action="" method="POST" id="questions" class="form-group">
            Public: <br>
            YES <input type='radio' name='public' value=TRUE checked="checked" required> 
            NO <input type='radio' name='public' value=FALSE><br></br>
            <input type='submit' value='Save' class='btn btn-dark'>
        </form>
        </div>
_END;
    }
    //if the survey isn't public check the no box
    else {
        echo <<<_END
        <h2>Update Public</h2>  
        <div class="container">
        <form action="" method="POST" id="questions" class="form-group">
            Public: <br>
            YES <input type='radio' name='public' value=TRUE required> 
            NO <input type='radio' name='public' value=FALSE  checked="checked"><br></br>
            <input type='submit' value='Save' class='btn btn-dark'>
        </form>
        </div>
_END;
    }
}

echo $message;

require_once "footer.php";

?>