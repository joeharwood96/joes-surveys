 <?php

require_once "header.php";
//Get the survey title from the url
$title = $_GET['surveyTitle'];

$connection = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
//get the username from the session
$username = $_SESSION['username'];
//select the question and surveyID of the survey that the user has clicked to view the results  
$query = "SELECT question, surveyID from questions where surveyID = (SELECT surveyID from surveys where surveyTitle = '$title' and username = '$username')";

$resultQ = mysqli_query($connection, $query);
//Number of questions
$nQuestion = mysqli_num_rows($resultQ);

    echo <<<_END
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>      
_END;
//For each of the questions add a chart
for ($i=0; $i<$nQuestion; $i++)
	{
        $rowQ = mysqli_fetch_assoc($resultQ);
        $question = $rowQ['question'];
        $surveyID = $rowQ['surveyID'];
        //Find the answer, the number of the same answers for each question 
        $query = "SELECT answer, COUNT(answer), questionID from answers group by answer having questionID = (select questionID from questions where question = '$question' and surveyID = '$surveyID');";

        // this query can return data ($result is an identifier):
        $resultA = mysqli_query($connection, $query);

        // how many rows came back?:
        $nAnswer = mysqli_num_rows($resultA);
        // fetch one row as an associative array (elements named after columns):  
        //Add javascript for the google charts api         
        echo <<<_END
        <script type="text/javascript">
        // Load the Visualization API and the controls package.
        google.charts.load('current', {'packages':['corechart', 'controls']});
  
        // Set a callback to run when the Google Visualization API is loaded.
        google.charts.setOnLoadCallback(drawDashboard);
  
        // Callback that creates and populates a data table,
        // instantiates a dashboard, a range slider and a pie chart,
        // passes in the data and draws it.
        function drawDashboard() {
  
          // Create our data table.
          var data = google.visualization.arrayToDataTable([
            ['Name', '$question'],       
_END;
            //For each question add each answer and the number of the same answer to the chart 
            for($j = 0; $j < $nAnswer; $j++){
                $rowA = mysqli_fetch_assoc($resultA);
                $answer = $rowA['answer'];
                $numAnswer = $rowA['COUNT(answer)'];
                echo <<<_END
                ['$answer',$numAnswer],
_END;
            }
            //Create a dashboard for each chart 
            //Add the questions as labels 
            //Create a range slider to filter the data
            echo <<<_END
            ]);
            // Create a dashboard.
            var dashboard = new google.visualization.Dashboard(document.getElementById('dashboard_div{$i}'));
    
            // Create a range slider, passing some options
            var RangeSlider = new google.visualization.ControlWrapper({
              'controlType': 'NumberRangeFilter',
              'containerId': 'filter_div{$i}',
              'options': {
                'filterColumnLabel': '$question'
              }
            });
    
            // Create a pie chart, passing some options
            var pieChart = new google.visualization.ChartWrapper({
              'chartType': 'PieChart',
              'containerId': 'chart_div{$i}',
              'options': {
                'width': 600,
                'height': 600,
                'pieSliceText': 'value',
                'legend': 'right'
              }
            });
    
            // Establish dependencies, declaring that 'filter' drives 'pieChart',
            // so that the pie chart will only display entries that are let through
            // given the chosen slider range.
            dashboard.bind(RangeSlider, pieChart);
    
            // Draw the dashboard.
            dashboard.draw(data);
          }
        </script>
        <div class= "container">
            <!--Div that will hold the dashboard-->
            <div id="dashboard_div{$i}">
                <!--Divs that will hold each control and chart-->
                <div id="filter_div{$i}"></div>
                <div id="chart_div{$i}"></div>
            </div>
        </div>
        
_END;
}

require_once "footer.php";
?>