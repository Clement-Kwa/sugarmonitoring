<?php
/*
  This page is to used to insert sugar reading into the table sugarreading (mySQL)
  This page is deliberately left blank.
 */
//<!--Clement Kwa 20002694-->
session_start();
include "dbFunction.php";

date_default_timezone_set("Asia/Singapore");
$date = date('y-m-d'); // Retreive the current date of user's entry

$userID = $_SESSION['user_id'];

$message = "";

//warning svg
$warn = '<svg xmlns="http://www.w3.org/2000/svg" style="color: gold" width="100" height="100" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16"><path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/></svg>';

//user bypass check
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
} else {
    //$userLoggedIn = ;
    $userLoggedIn = "Logged in as: " . $_SESSION['username'] . "\n";
}

if (isset($_POST['entered_level'])) {
    
    //Retrieve user's readingTimes and readinglevel
    $readingTimes = $_POST['entered_level'];
    $readingLvl = $_POST['entered_time'];

    $userID = $_SESSION['user_id'];

    $queryCheck = "INSERT INTO sugarreading(userID, readingDate, readingTimes, readingLvl) "
            . "VALUES ('$userID','$date', '$readingLvl','$readingTimes')";

    $resultCheck = mysqli_query($link, $queryCheck) or die(mysqli_error($link));

    if ($resultCheck == 1) {
        header("Location: sugarMonitoring.php");
        exit();
    } else {
        $message = "<p>" . $warn . "</p>";
        $message .= "<h3><p>An error has occured. Please try again.</p></h3>";
        $message .= "<p> <h4><a href='sugarMonitoring.php'>Back</a></h4> </p>";
        $message .= "<p><div style='font-style: italic; opacity: 0.5;'><br>Error: Insertion of data failed unexpectedly.</div></p>";
    }
} else {
    $message = "<p>" . $warn . "</p>";
    $message .= "<h3><p>No entered data was found. Please try again.</p></h3>";
    $message .= "<p> <h4><a href='sugarMonitoring.php'>Back</a></h4> </p>";
    $message .= "<p><div style='font-style: italic; opacity: 0.5;'><br>Error: No entered data was found, or data was incomplete.</div></p>";
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sugar Monitoring</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/all.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-3.6.0.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg" style="colour:black;  background-color: #D9F9FF; ">
            <div class="navbar-brand">
                <img src="images/blood-pressure-royalty-free-nsito108-transparent.png" alt="logo image" width="60px" height="50px"/>
                Sugar Monitoring App
            </div>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarText">

                <ul class="navbar-nav ml-auto">
                    <span class="navbar-text" style="font-style: italic; opacity: 0.6;margin-right: 20px"> 
                        <?php echo $userLoggedIn ?> 
                    </span>

                    <li class="nav-item active">
                        <a href="doLogOut.php" class="btn btn-danger">Log Out</a>
                    </li>
                </ul>

            </div>
        </nav>

        <div class="col-md-12 p-5" >


            <?php
            echo $message;
            ?>


        </div>
    </body>
</html>
