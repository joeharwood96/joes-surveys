<?php

// execute the header script:
require_once "header.php";

//The welcome page
//Detials the setup of the website and the documentation    
echo <<<_END

<h1>Welcome to Joe's Survey Website</h1>

<h2>Setup:</h2> <br>

<p>
•	Run create_data.php. <br>
•	Go back to the index and run about.php. <br>
•	Navigate to the Sign In page using the navigation bar/ Sign up page to create a new user. <br>
•	Use the Username: Admin and Password: Secret to sign in. <br>
•	Users will then be brought to the Account page where users are able to update 
user profiles.</p> <br>

<h2>Documentation:</h2> <br> 

<h2>User Accounts: </h2>

<p>
Users can create a profile which is stored using the sign_up.php file. <br>
The user must provide information such as: <br>
•	Username <br>
•	Password <br>
•	First name <br>
•	Last name <br>
•	Email <br>
•	D.O.B <br>
•	Telephone number <br>
</p>

<p>
<img src="img/yes.png" alt="Chess Pieces" style="padding-right: 5px; float:left;width:250px;">
Users then must sign in with their chosen Username and Password. Once signed 
in users can navigate to the account.php file through the navigation bar and 
there are able to update their information and store it.
</p>

<p>
If the user is a admin then they will be able to navigate to the admin tools 
page (admin.php) this shows a table of tools including users tool and survey tools. 
User tools allows the admin to update delete user data. The Survey tool allows 
admin to; update questions in a specific survey, add questions to specific survey delete 
surveys and change wether a survey is public or not.
</p> <br></br>

<h2>Design and Analysis:</h2>

<p>
This section of the website is a competitor analysis of other survey websites. 
It provides an in-depth look how survey websites work and create user experiences.
The survey websites that are analysed in this section are as follows: <br>
•	Survey Monkey <br>
•	Google Forms <br>
•	Lime Survey <br>
</p>

<p>
When analysing these websites five main criteria where used to gain a full scope. <br>
The criteria are: <br>
•	Layout/presentation of surveys <br>
•	Ease of use <br>
•	User account set-up/login process <br>
•	Question types <br>
•	Analysis tools <br>
</p>

<p>I then concluded and discussed which of these websites I favoured and which parts
I would like to include into my survey website.</p>

<h2>Survey Management:</h2>

<p>
When users are signed into the website they are able to navigate to the accounts page (account.php). 
Here users can see a table of their previously created surveys by scrolling to the bottom of the page.
From here users are able to click three buttons: Update, Delete and results. When clicking the update 
button users are brought to the edit_survey.php page which shows them a table of the questions
corresponding to the survey that they wished to update. Users can then update a question, add a new
question, delete a question and change if the survey is public or not.
</p>

<p>
Users can create a new survey by clicking on the create survey button which brings them to the new_survey.php 
page and allows them to add; a title for the survey, questions to the survey and finally wether the survey
will be public or not. Once the survey is saved it will appear in the list of surveys on the account.php page.
</p>

<p>
If a survey is public all users will be able to see the survey and complete it only when signed in by Navigating
to the public_surveys.php page and clicking on a survey. If users are not currently signed in they will still 
be able to see surveys by navigating to the public_surveys.php but will be unable to complete surveys.
</p>

<h2>Survey Results:</h2>

<p>
When user is on the view_account.php page and scroll down the to bottom they will see a table of their current
surveys. By clicking the green results button users are able to view the results of a specific surveys. Once 
other users have completed the survey the results are automatically updated.
</p>

<p>
The survey results are set out in pie charts for each question in the specific survey. That means that each user
has his/her own set of results for each survey. Scroll down through the results to view each questions results.
</p>

<p>
These charts can be filtered using statistical data. The results are constructed from 
the number of users that provide responses. 
</p>

_END;


// finish of the HTML for this page:
require_once "footer.php";

?>