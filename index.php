<!DOCTYPE html>
<!--
Allows user to login or register. You can choose to have a separate registration page.
This page is deliberately left blank.

-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Sugar Monitoring</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/all.min.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="js/jquery-3.6.0.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <!--Clement Kwa 20002694-->
        <!--This style tag extends the body tag to fill entire screen-->
        <style>
            html,body {
                height: 100%;
            }
        </style>
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

        <div class="d-md-flex h-100"  >
            <div class="col-md-4 p-5 h-100">
                <form method="post" action="doRegister.php">
                    <div class=" form-group col-md-8">
                        <div class="form-group">
                            <h2 >Register with us now!</h2><hr>
                        </div>
                        <div class="form-group">
                            <input type="text" required class="form-control" name="username" placeholder="Username">
                        </div>                      
                        <div class="form-group">

                            <input type="password" required class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input type="number" required min="1" max="300" class="form-control" name="height" placeholder="Height in cm">
                        </div>
                        <div class="form-group">
                            <input type="number" required min="1" max="1000" class="form-control" name="weight" placeholder="Weight in kg">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Sign Up</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-8" style="background-image: url('images/kalen-emsley-Bkci_8qcdvQ-unsplash.jpg');" class="img-fluid">
            </div>
        </div>
    </body>
</html>
