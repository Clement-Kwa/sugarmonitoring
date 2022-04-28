<?php
//<!--Clement Kwa 20002694-->
include "dbFunction.php";

$username = $_POST['username'];
$password = $_POST['password'];
$height = $_POST['height'];
$weight = $_POST['weight'];

//duplicate check query
$queryA = "SELECT * 
          FROM user  
          WHERE username='$username'";

$statusA = mysqli_query($link, $queryA);
//retrieve and store results
$rows = mysqli_num_rows($statusA);

//warning svg
$warn = '<svg xmlns="http://www.w3.org/2000/svg" style="color: gold" width="100" height="100" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16"><path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/></svg>';

//info svg
$info = '<svg xmlns="http://www.w3.org/2000/svg" style="color: #17a2b8" width="100" height="100" fill="currentColor" class="bi bi-info-circle-fill" viewBox="0 0 16 16">
                        <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
                        </svg>';

$check = '<svg xmlns="http://www.w3.org/2000/svg" style="color: #28a745" width="100" height="100" fill="currentColor" class="bi bi-check-circle-fill" viewBox="0 0 16 16">
  <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
</svg>';


if ($rows > 0) {
    $message = "<p>" . $info . "</p>";
    $message .= "<h3><p>Sorry! This username is already in use.</p></h3>";
    $message .= "<p> <h4><a href='index.php'>Try another username</a></h4> </p>";
    $message .= "<p><div style='font-style: italic; opacity: 0.5;'><br>Error: Username already exists.</div></p>";
} else {
    $query = "INSERT INTO user
          (username,password, height, weight) 
          VALUES 
          ('$username', SHA1('$password'),'$height','$weight')";

    $status = mysqli_query($link, $query);

    if ($status) {
        $message = "<p>" . $check . "</p>";
        $message .= "<h3><p>Account successfully created!</p></h3>";
        $message .= "<p> <h4>You can now <a href='index.php'>login</a> as a user.</h4> </p>";
    } else {
        $message = "<p>" . $warn . "</p>";
        $message .= "<h3><p>Registration failed. Please try again.</p></h3>";
        $message .= "<p> <h4><a href='index.php'>Back</a></h4> </p>";
        $message .= "<p><div style='font-style: italic; opacity: 0.5;'><br>Error: Insertion of data failed unexpectedly.</div></p>";
    }
}

mysqli_close($link);
?>
<!DOCTYPE HTML>
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

        <div class="col-md-12 p-5" >
            <?php
            echo $message;
            ?>
        </div>
    </body>
</html>