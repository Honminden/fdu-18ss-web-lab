<?php
//Fill this place


$mysqli = new mysqli('localhost', 'root', '', 'travel');
if (mysqli_connect_errno())
{
    die("mysqli connect error" . mysqli_connect_error());
}

$continents = $mysqli -> query('SELECT * from continents');
$countries = $mysqli -> query('SELECT * from countries');
$imageDetails = $mysqli -> query('SELECT * from imagedetails');

$mysqli = null;

//****** Hint ******
//connect database and fetch data here

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Lab11</title>

      <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href='http://fonts.googleapis.com/css?family=Lobster' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/bootstrap.min.css" />
    
    

    <link rel="stylesheet" href="css/captions.css" />
    <link rel="stylesheet" href="css/bootstrap-theme.css" />    

</head>

<body>
    <?php include 'header.inc.php'; ?>
    


    <!-- Page Content -->
    <main class="container">
        <div class="panel panel-default">
          <div class="panel-heading">Filters</div>
          <div class="panel-body">
            <form action="Lab11.php" method="get" class="form-horizontal">
              <div class="form-inline">
              <select name="continent" class="form-control">
                <option value="0">Select Continent</option>
                <?php
                //Fill this place

                $result = $continents;

                //****** Hint ******
                //display the list of continents

                while($row = $result->fetch_assoc()) {
                  echo '<option value=' . $row['ContinentCode'] . '>' . $row['ContinentName'] . '</option>';
                }

                ?>
              </select>     
              
              <select name="country" class="form-control">
                <option value="0">Select Country</option>
                <?php 
                //Fill this place

                $result = $countries;
                while($row = $result->fetch_assoc()) {
                    echo '<option value=' . $row['ISO'] . '>' . $row['CountryName'] . '</option>';
                }

                //****** Hint ******
                /* display list of countries */ 
                ?>
              </select>    
              <input type="text"  placeholder="Search title" class="form-control" name=title>
              <button type="submit" class="btn btn-primary">Filter</button>
              </div>
            </form>

          </div>
        </div>     
                                    

		<ul class="caption-style-2">
            <?php 
            //Fill this place

            $result = $imageDetails;
            $hasContent = false;
            while($row = $result->fetch_assoc()) {
                if ((empty($_GET['continent']) || ($row['ContinentCode'] === $_GET['continent']))
                    && (empty($_GET['country']) || ($row['CountryCodeISO'] === $_GET['country']))
                    && (empty($_GET['title']) || ($row['Title'] === $_GET['title'])))
                {
                    echo '<li>';
                    echo '  <a href="detail.php?id=' . $row['ImageID'] . '" class="img-responsive">';
                    echo '    <img src="images/square-medium/' . $row['Path'] . '" alt="' . $row['Title'] . '" >';
                    echo '    <div class="caption">';
                    echo '      <div class="blur"></div>';
                    echo '      <div class="caption-text">';
                    echo '        <p>' . $row['Description'] . '</p>';
                    echo '      </div>';
                    echo '    </div>';
                    echo '  </a>';
                    echo '</li>';
                    $hasContent = true;
                }
            }
            if (!$hasContent)
            {
                echo '<h1>No content here!</h1>';
            }

            //****** Hint ******
            /* use while loop to display images that meet requirements ... sample below ... replace ???? with field data
            <li>
              <a href="detail.php?id=????" class="img-responsive">
                <img src="images/square-medium/????" alt="????">
                <div class="caption">
                  <div class="blur"></div>
                  <div class="caption-text">
                    <p>????</p>
                  </div>
                </div>
              </a>
            </li>        
            */ 
            ?>
       </ul>       

      
    </main>
    
    <footer>
        <div class="container-fluid">
                    <div class="row final">
                <p>Copyright &copy; 2017 Creative Commons ShareAlike</p>
                <p><a href="#">Home</a> / <a href="#">About</a> / <a href="#">Contact</a> / <a href="#">Browse</a></p>
            </div>            
        </div>
        

    </footer>


        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
</body>

</html>