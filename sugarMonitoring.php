<?php
//<!--Clement Kwa 20002694-->
session_start();

include "dbFunction.php";

//user bypass check
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
} else {
    //$userLoggedIn = ;
    $userLoggedIn = "Logged in as: " . $_SESSION['username'] . "\n";
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
        <script type="text/javascript">
            $(document).ready(function ()
            {
                $("form").submit(function () {
                    // complete the code here
                    var level = $('#entered_level').val();
                    var time = $('#entered_time').val();
                    var sugarLevel = "";
                    var message = "";

                    message += "Your reading entered after ";

                    //shipping method
                    $("#entered_time :selected").each(function () {
                        // complete the code here
                        var shipMeth = $(this).val();
                        message += shipMeth + " is: ";

                    });

                    message += level + " mmol/L. \n";

                    if (level <= 7.8) {
                        sugarLevel = "Normal";
                    } else if (level > 7.8 && level < 11) {
                        sugarLevel = "Elevated";
                    } else {
                        sugarLevel = "High";
                    }

                    message += "Your sugar level is " + sugarLevel + ". \nProceed to submit reading?";

                    var box = confirm(message);

                    if (box == true) {
                        return true;
                    } else {
                        return false;
                    }

                });
            });
        </script>
        <script>
            $(document).ready(function () {

                $.ajax({
                    type: "GET",
                    url: "getReading.php",
                    data: "userID=<?php echo $_SESSION['user_id'] ?>",
                    cache: false,
                    dataType: "JSON",
                    success: function (response) {
                        var message = "";
                        for (i = 0; i < response.length; i++) {
                            message += "<tr> <th scope='row'>" + response[i].readingDate + "</th>"
                                    + "<td>" + response[i].readingTimes + "</td>"
                                    + "<td>" + response[i].readingLvl + "</td></tr>";
                        }

                        $("#entryTable").html(message);
                    },
                    error: function (obj, textStatus, errorThrown) {
                        console.log("Error " + textStatus + ": " + errorThrown);
                    }
                });
            });
        </script>
    </head>
    <body>

        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #D9F9FF;">
            <div class="navbar-brand">
                <img src="images/blood-pressure-royalty-free-nsito108-transparent.png" alt="logo image" width="60px" height="50px"/>
                Sugar Monitoring App
            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarText">

                <ul class="navbar-nav ml-auto">
                    <span class="navbar-text" style="font-style: italic;margin-right: 20px"> 
                        <?php echo $userLoggedIn ?> 
                    </span>

                    <li class="nav-item active">
                        <a href="doLogOut.php" class="btn btn-danger">Log Out</a>
                    </li>
                </ul>

            </div>
        </nav>

        <div class="d-md-flex" >
            <div class="col-md-2 p-5">
                <h2>Blood Sugar Level Readings</h2>
                <hr>
                <form method="post" action="insertReading.php">
                    <div class="form-group">
                        <h5><label for="entered_time">Reading taken after:</label></h5>
                        <select id="entered_time" name="entered_time" class="form-control">
                            <option selected>Breakfast</option>
                            <option value="Lunch">Lunch</option>
                            <option value="Dinner">Dinner</option>
                        </select>
                    </div>
                    <div style="font-style: italic; opacity: 0.5;">Note: Readings are to be taken 2 hours after each meal.</div><br>
                    <div class="form-group">
                        <h5><label for="entered_level">Blood Sugar Level Readings (in mmol/L):</label></h5>
                        <input type="number" required min="1" max="150" id="entered_level" name="entered_level" class="form-control"/>
                    </div>
                    <input class="btn btn-primary" type="submit" value="Submit"/>
                    <hr>
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" style="color: #17a2b8" width="30" height="30" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                        </svg> <b style='margin-left: 5px; color: #17a2b8; '>Instructions</b>
                    </div>
                    <div style='opacity: 0.5; margin-top: 5px'>
                        Enter the time taken after the reading with the dropdown list and enter the reading in mmol/L. <br>After submitting, the recording will shown on the table on the right.
                    </div>

                </form>
            </div>

            <div class="col-md-10 p-5" >



                <div id="div2-2">
                    <table class="table table-striped" >
                        <thead>
                            <tr>
                                <th scope='col'>Date</th>
                                <th scope='col'>After-Meals Reading</th>
                                <th scope='col'>Reading</th>
                            </tr>
                        </thead>
                        <tbody id="entryTable">

                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </body>
</html>
