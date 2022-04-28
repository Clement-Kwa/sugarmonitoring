<?php
//<!--Clement Kwa 20002694-->
session_start();


include "dbFunction.php";


$message = "";

//warning svg
$warn = '<svg xmlns="http://www.w3.org/2000/svg" style="color: gold" width="100" height="100" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16"><path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/></svg>';


if (!isset($_POST['username'])) {
    //Check if entered login details (username, password)
    header("Location: index.php");
    exit();
    
} else {
    $entered_username = $_POST['username'];
    $entered_password = $_POST['password'];

    $queryCheck = "SELECT * FROM user
          WHERE username='$entered_username'
          AND password = SHA1('$entered_password')";

    $resultCheck = mysqli_query($link, $queryCheck) or die(mysqli_error($link));

    if (mysqli_num_rows($resultCheck) == 1) {
        $row = mysqli_fetch_array($resultCheck);

        $_SESSION['user_id'] = $row['userid'];
        $_SESSION['username'] = $row['username'];

        $_SESSION['height'] = $row['height'];
        $_SESSION['weight'] = $row['weight'];

        header("Location: sugarMonitoring.php");
        exit();
    } else {
        $message = "<p>" . $warn . "</p>";
        $message .= "<h3><p>Incorrect login information. Please try again.</p></h3>";
        $message .= "<p> <h4><a href='index.php'>Back</a></h4> </p>";
        $message .= "<p><div style='font-style: italic; opacity: 0.5;'><br>Error: Entered username and/or password is incorrect.</div></p>";
    }
}
?>

<!DOCTYPE html>
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

            <button class="navbar-toggler navbar-light" type="button" data-toggle="collapse" data-target="#navbarSupportedContent">
                <span class="navbar-toggler-icon "></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                    </li>
                </ul>
                <form class="form-inline" method="post" action="doLogin.php">
                    <input class="form-control mr-sm-2" type="text" required placeholder="Username" name="username">
                    <input class="form-control mr-sm-2" type="password" required placeholder="Password" name="password">
                    <button class="btn btn-success my-2 my-sm-0" type="submit" id="login">Login</button>
                </form>
            </div>
        </nav>
        
        <div class="ml-5" style="margin-top: 60px;">
            <h4>
                <?php
                echo $message;
                ?>
            </h4>
        </div>
    </body>
</html>