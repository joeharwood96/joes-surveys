<?php

// Things to notice:
// You need to add your Analysis and Design element of the coursework to this script
// There are lots of web-based survey tools out there already.
// It’s a great idea to create trial accounts so that you can research these systems. 
// This will help you to shape your own designs and functionality. 
// Your analysis of competitor sites should follow an approach that you can decide for yourself. 
// Examining each site and evaluating it against a common set of criteria will make it easier for you to draw comparisons between them. 
// You should use client-side code (i.e., HTML5/JavaScript/jQuery) to help you organise and present your information and analysis 
// For example, using tables, bullet point lists, images, hyperlinking to relevant materials, etc.

// execute the header script:
require_once "header.php";

if (!isset($_SESSION['loggedInSkeleton']))
{
	// user isn't logged in, display a message saying they must be:
	echo "You must be logged in to view this page.<br>";
}
//If user is logged in then show the competitor report
else
{
	echo <<<_END
	<!DOCTYPE html>
	<html lang="en">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="style1.css">
		<title>Competitors</title>
	</head>
	<body>
		<h1>Competitor Analysis</h1> 
		<h2>Survey Monkey</h2> 
		<h3>User account setup/login process</h3> 

		<p>hen setting up an account with survey monkey the user is asked for: </p>

		<ul>
			<li>Username</li>
			<li>Password</li>
			<li>Email</li>
			<li>First name</li>
			<li>Last name</li>
		</ul>

		<img src="surveymonkey/surveymonkey1.png" height="400" width="450">

		<p>The form used for this is simple and clean, inputs are layout in 
			a vertical row allowing users to easily tab from one input to the next. 
			The create account button is large and easy to find. 
			The minimal input fields make for a user-friendly signup process.
		</p>

		<p>Users can also use third-party websites to sign up, these include: </p>

		<ul>
			<li>Google</li>
			<li>Facebook</li>
			<li>Office 365</li>
			<li>LinkedIn</li>
		</ul>

		<p>These third-party access points allow survey monkey to quickly access the 
			information needed for the sign-up process, also giving users a smoother and 
			faster way of signing-up.</p>
		<p>The login page also follows the simple design, the user is asked simply for 
			a username and password. The user can also check the remember me box for quicker 
			access to the website on their return.</p>
		<p>Both the sign-up and login page have authentication, for example on the sign-up 
			page the user must enter a valid email and it must be unique. On the login page 
			usernames and passwords must match a valid user.</p>

		<h3>Question types</h3>
		<p>Survey monkey gives its users a variety of options and question types. 
			When creating questions with survey monkey the user has the option to use recommended 
			question from the “Question bank”, these questions are a mixture of the sites 
			most asked questions and categories such as: </p>

		<ul>
			<li>Educational</li>
			<li>Events</li>
			<li>Healthcare</li>
			<li>Political</li>
		</ul>

		<img src="surveymonkey/surveymonkey2.png" height="400" width="800">

		<p>Users can also create unique questions by typing out the question and then using a 
			drop-down menu to decipher the type of questions, there are many types that the user 
			can choose from these include but are not limited to: </p>

		<ul>
			<li>Drop-down menu</li>
			<li>Checkboxes</li>
			<li>Sliders</li>
			<li>Star ratings</li>
			<li>Textboxes</li>
			<li>Date/Time</li>
		</ul>

		<h3>Layout/presentation</h3>

		<p>Once a user has created the survey it can be previewed, this allows the admin to
			view the survey before it is released to the public. With survey monkey the current 
			question is shown with the questions still to come faded in the back ground which gives 
			an effect of the questions popping out of the page and adds a more dynamic element to the 
			page. Questions are centred and bold, this makes the user focus on the questions without any 
			distractions.</p>
		<p>The header of the page holds the title of the survey (Companies/ Organisations can also place
			a logo here). The footer of the page makes use of a progress bar telling the user how many 
			questions are unanswered and how many have already been answered. </p>
		
		<img src="surveymonkey/surveymonkey3.png" height="400" width="800">

		<h3>Ease of use</h3>

		<p>Survey monkey is extremely easy to use from the login/ sign-up system to the creation of surveys. 
			Its fast integration of recommended questions means that users can quickly implement surveys and 
			share them to the public. </p>
		<p>The layout of a survey monkey page is minimal in design, less clutter allows users to focus their 
			attention on survey creation. Icons are used for easy understanding of each attribute, users can 
			easily distinguish between buttons, categories etc.</p>
		<p>Surveys can however become more complicated if needs be. When users upgrade to the paid service 
			logic tools can be added to the surveys that allow for a more customised experience. Some examples 
			of these logic tools are: </p>

		<ul>
			<li>Page skip logic</li>
			<li>Page randomization</li>
			<li>Block randomization</li>
			<li>Custom variables</li>
		</ul>

		<img src="surveymonkey/surveymonkey4.png" height="400" width="300">

		<p>The added logic features bring with them an added complexity to creating surveys and more novice users 
			may find them confusing.</p>

		<h3>Analysis tools</h3>

		<p>To analyse public surveys there are several useful tools given to a user on Survey Monkey.  Users can 
			use filters to specify the exact data that users want to view, this can be done in several different 
			ways making the analysis of data very customizable, data can be filtered by:</p>
		
		<ul>
			<li>Questions</li>
			<li>Answers</li>
			<li>Completeness</li>
			<li>Time</li>
			<li>Custom variable</li>
		</ul>

		<p>The next useful tool for users is the compare tool, this allows users to compare how different groups 
			of people answered their survey. Again, the compare tool can be used to compare specific questions and 
			answers. The final tool is the show tool that allows users to specify which page of data will be shown, 
			this is useful if there is a large amount of data.</p>
		<p>When displaying the data collected from the results of surveys Survey Monkey uses graphics. These graphics
			are easy to understand and clearly laid out, they make use of different types of charts depending on the 
			type of data provided, these can be bar charts, pie charts and line charts.</p>
		<p>Survey monkey also allows the users to view data trends (which answers are most common in each time frame)
			and individual responses looking deeper into a single participant’s data.</p>

		<img src="surveymonkey/surveymonkey5.png" height="400" width="600">
		<img src="surveymonkey/surveymonkey6.png" height="400" width="600">

		<h2>Google Forms</h2> 
		<h3>User account setup/login process</h3> 

		<p>Setting up an account with Google Forms is extremely easy, it is especially simple if the user already has a 
			google account. Login automatically occurs for users using google chrome and have a google account. However, 
			if the user wishes to create a new account it can only be done using a google email, there is no way of creating 
			account using other third party companies. This means that the user must also create a new email account.</p>
		<p>When creating a new google account the user experience is intuitive, the user enters limited fields that are well 
			set out. The input fields are text based these include:</p>
		
		<ul>
			<li>First name</li>
			<li>Last name</li>
			<li>New email address</li>
			<li>Password</li>
			<li>Confirm password</li>
		</ul>
		
		<img src="google forms/google1.png" height="400" width="500">

		<p>Validation for the form is simple and shows up firmly in red. New emails must be unique and when 
			creating a password users must use eight or more characters with a mixture of letters, numbers 
			and symbols.</p>
			
		<h3>Qestion types</h3>

		<p>Google forms has several options for questions, users can use survey templates to quickly implement 
			their surveys. These templates are in several categories such as:</p>

		<ul>
			<li>Party invites</li>
			<li>RSVP</li>
			<li>Event feedback</li>
			<li>Order forms</li>
			<li>Many more</li>
		</ul>

		<img src="google forms/google2.png" height="400" width="600">

		<p>These templates can be very useful but do not always have all the desirable fields and can have a lot of extra 
			useless inputs. When using google forms users are also able to create surveys from scratch which is a much 
			more customizable experience. Questions are input into a text field and then users can pick from several question
			types which include:</p>

		<ul>
			<li>Party invites</li>
			<li>RSVP</li>
			<li>Event feedback</li>
			<li>Order forms</li>
			<li>Many more</li>
		</ul>

		<p>Although google does have many customizable questions and types it is still limited compared to other survey 
			websites like survey monkey.</p>
		
		<h3>Layout/presentation of surveys</h3>

		<p>Google forms has a useful tool that allows users to preview their surveys before sending them to the public. 
			When previewing the survey the users can see the layout of their finished surveys and how the participants 
			will interact with the survey. The survey is simple in design but allows users of google forms a lot customizable
			freedom, users can include pictures, background colours, logos and more.</p>

		<p>Surveys are set out in a linear structure that allows users to easily identify which question have the user is 
			currently filling out. However, there is no progress bar whilst filling out the survey which means if users leave 
			the page or accidently scroll up users must find their place in the survey.</p>
		
		<img src="google forms/google3.png" height="400" width="200">

		<p>In google forms there are also added options for themes, in this option a user can add a header photo, the background 
			colour and font size. This adds another layer of customable content.</p>

		<h3>Ease of use</h3>

		<p>Google form is an easy and useful way of quickly implementing surveys. It has very little clutter and well explained 
			help functions to allows novice users to create quick simple surveys. This does mean however that more complex surveys 
			are more difficult to make, larger companies may wish to use alternative sites with more functionality.</p>
		
		<img src="google forms/google4.png" height="400" width="650">

		<p>Buttons are in easy to find locations and their icons describe them well in most cases, some however are more difficult 
			to work out but hovering over them allows the user to be greeted with a short description.</p>
		
		<p>For already established google account holders sign up and logging in to google forms is extremely easy and time efficient, 
			for those without a google account the process is more tedious as the user must set up a new email account. I feel like 
			the use of other third part login systems would be beneficial in this area.</p>

		<h3>Analysis tools</h3>

		<p>Google forms makes use of graphical charts for its analysis of survey results. The data is colourfully laid out in bar, pie, 
			line and other charts so that users can clearly read and understand their data.</p>

		<p>The data is set into two parts, the first part is summery, this is the summery of all the data collected during the surveys 
			life cycle. Here all responses are collected and graphically shown for users to get an overall picture.  The second part is 
			individual data which shows how each individual participant of the survey answered each question, allowing the users to go 
			more in-depth with their results.</p>
		
		<p>Google forms also has several useful tools when analysing and collecting data. These tools are as follows:</p>

		<ul>
			<li>Get emails for new responses</li>
			<li>Select responses destination</li>
			<li>Download responses</li>
			<li>Print responses</li>
			<li>Delete all responses</li>
		</ul>

		<p>Finally google forms also has a useful tool for collecting the data and allowing the user to then create a spreadsheet 
			automatically with the results of the survey. This is useful for storing data for further use.</p>
		
		<img src="google forms/google5.png" height="300" width="600">
		<img src="google forms/google6.png" height="300" width="600">

		<h2>Lime Survey</h2>
		<h3>User account set-up/login process</h3>

		<p>Creating accounts with lime survey can be easily done with a layout that is in a linear design much like the previously 
			analysed websites. Users can create a new account by simply entering:</p>

		<ul>
			<li>Username</li>
			<li>Email</li>
			<li>Password</li>         
		</ul>

		<p>The user must also input a security question to ensure that the user is a valid user and not a bot.</p>

		<img src="limesurvey/limesurvey1.png" height="400" width="650">

		<p>Users can also sign up using three different third party companies, this enables users to simply sign in to those 
			accounts and information is directly stored to LimeSurvey. This allows for a fast and easily accessible user experience. 
			The third-party companies are as follows:</p>

		<ul>
			<li>Twitter</li>
			<li>Google</li>
			<li>Github</li>         
		</ul>

		<p>When signing in users can sign in with just a username and password. Users can save their data for quick access.</p>

		<h3>Question types</h3>

		<p>When creating questions with Lime Survey users have a very large array of options to make the questions as complex as 
			they wish. Lime survey allows users to save each question in a database style with primary keys which allows for large 
			surveys to be created and managed.</p>

		<img src="limesurvey/limesurvey2.png" height="400" width="600">

		<p>Lime survey is very in-depth and allows users to change the functionality of surveys and the features of the surveys. Lime
			survey gives users more customizable freedom with such features as:</p>

		<ul>
			<li>Mandatory selection</li>
			<li>Question types</li>
			<li>Relevance equations</li> 
			<li>Validation</li>        
		</ul>

		<p>The actual question types offered to users are also very in-depth and users can specialize their questions to a large degree. 
			A large array of types can be accessed with subtypes under each category one example of a type would be single choice questions 
			which has subtypes like 5-point choice, lists (dropdown), list(radio), lists with comments etc.</p>

		<h3>Analysis tools</h3>

		<p>As with most features with lime survey user’s customization is extremely varied and in-depth when analysing surveys. Once user 
			have created and published their surveys using lime surveys users can track how they are doing thought several different mediums. 
			The first way in which uses can customize the data is by general filtering such as:</p>

		<ul>
			<li>Response ID greater than and less than feature</li>
			<li>Complete/Incomplete only</li>
			<li>All available fields</li>       
		</ul>

		<img src="limesurvey/limesurvey3.png" height="400" width="350">

		<p>Users can then choose to filter data further by going to response filters, this allows users to filter data by demographics such 
			as age, gender and employment statistics. Finally, a graphical output will be given for the filtered data. This complex system 
			allows for big sets of data to be filtered to a smaller more manageable size. This is very useful for large companies that expect
			many responses. Data can then be put into a report in the form of HTML, PDF and Excel format.</p>

		<h3>Layout/presentation of surveys</h3>

		<p>Layouts on lime survey follow a very similar layout to both Google form and Survey Monkey, its linear and straight forward to use. 
			Questions are in a linear format and well-spaced to indicate the changing of a question.</p>
		
		<p>Questioned are not numbered however meaning that in larger surveys it may be difficult to keep track of which question the users are
			answering. There is also no use of a progress bar so users don’t know how many questions are left to answer, this can be advantageous 
			in larger surveys as users may lose interest when viewing how long the survey will take.</p>
		
		<img src="limesurvey/limesurvey4.png" height="400" width="500">

		<p>Creators of the surveys have many style customization for surveys due to the integration of lime surveys HTML and CSS features. Users 
			can be as creative and diverse as they wish, users can create their own CSS files or edit directly on the platform. Lime survey also 
			has several ready-made themes for users to use but these themes are largely limited to changing just the colours of buttons and text.</p>
		
		<h3>Ease of use</h3>

		<p>Lime Survey is not created for majority of the public, professional tools can be used on lime survey to create in-depth, detailed and
			extremely customizable surveys. Users can easily get lost in the variety that lime survey offers, this can take hours to learn and dive 
			deep into. Users that want quick and easy surveys should use other platforms such as google forms.</p>

		<p>More novice users may find it hard to navigate lime survey as its settings and structure is optimized for users as lime Surveys navigation
			bars to not give users much information. Users can often get lost in Lime surveys large array of options. Use of language in lime survey
			is of more technical savvy demographics and icons that do not describe as well as other survey websites.</p>

		<img src="limesurvey/limesurvey5.png" height="400" width="700">

		<p>Lime Survey does provide first time users with a quick guide (as shown above) on using some of the functions but does not go into depth as 
			much as is needed.</p>
		
		<p>The unique selling point however of Lime Survey is also its customizable and detailed creation proses. Lime Survey is tailored to business 
			professionals that wish to create in-depth and customizable surveys. These can be either created with HTML or on the platform which allows 
			for more detail. Businesses can use lime survey to gain detailed analytics on high quantities of data which may overwhelm novice users.</p>

		<h2>Conclusion</h2>
		
		<p> In conclusion, all three of the survey websites above have aspects that are useful and that I would like to incorporate into my survey site, 
		but they have many differences. Survey monkey is an all-round website with its ease of use and possibility to add lots of customisation, this is 
		what makes it my favourite. Google forms is also very easy to use but lacks customisation, the surveys could be made better by adding features 
		such as a randomisation or a progress bar. Finally lime survey is a survey site to be used by professionals and companies that wish to get full 
		customisation and professional looking surveys. To improve lime surveys or to bring it to a more mass ordinance I would simplify the site and add 
		more instructions for those less technical users.</p>
	</body>
	</html>

_END;
}

// finish off the HTML for this page:
require_once "footer.php";
?>