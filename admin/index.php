<?php session_start();
include("../config.php");
    if(isset($_POST['login'])){
        if($_POST['login'] == "admin" && $_POST['password'] == "admin"){
            $_SESSION['is_admin'] = 1;
            header('Location: '.$app_url."admin/dashboard.php");
        }else{
            header('Location: '.$app_url."admin/index.php");
        }
    }else{
        if(isset($_SESSION['is_admin'])){
            header('Location: '.$app_url."admin/dashboard.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <!-- basic -->
      <meta charset="utf-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- mobile metas -->
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="viewport" content="initial-scale=1, maximum-scale=1">
      <!-- site metas -->
      <title>Oxfam Informatique</title>
      <meta name="keywords" content="">
      <meta name="description" content="">
      <meta name="author" content="">
      <!-- bootstrap css -->
      <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
      <!-- style css -->
      <link rel="stylesheet" type="text/css" href="../css/style.css">
      <!-- Responsive-->
      <link rel="stylesheet" href="../css/responsive.css">
      <!-- fevicon -->
      <link rel="icon" href="images/fevicon.png" type="image/gif" />
      <!-- Scrollbar Custom CSS -->
      <link rel="stylesheet" href="../css/jquery.mCustomScrollbar.min.css">
      <!-- Tweaks for older IEs-->
      <!-- fonts -->

      <style>
        .liens-ox{
            color: black !important;
        }
        body{
            background-color: #3f405e;
            
        }
        form{
            /* background-image: url('../images/login.PNG'); */
            background-repeat: no-repeat;
            margin-top: 20%;
            padding: 30px;
        }
        h1{
            color : white;  
            text-align: center;
            padding-top: 40px;
        }
        h2{
            text-align: center;
        }
      </style>
   </head>
   <body>
      
   <div class="container">
        <div class="row justify-content-center">
        <div class="col-7 ">
            <h1>Oxfam Informatique</h1>
            <form class="card" action="" method="post">
                <h2>Connexion Admin</h2>
                <div class="form-group">
                    <label for="login" class="col-form-label">Login</label>
                    <input type="text" class="form-control" id="login" name="login">
                </div>
                
                <div class="form-group">
                    <label for="password" class="col-form-label">Mot de passe:</label>
                    <input type="text" class="form-control" id="password" name="password">
                </div>

                <div class="form-group">
                   <center><button class="btn btn-primary" type="submit">Valider</button></center>
                </div>
            </form>
        </div>
        </div>
        
    </div>

        </body>
</html>