<!DOCTYPE html>
<html>
  <head>
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link type="text/css" rel="stylesheet" href="css/materialize.css"  media="screen,projection"/>
    <link type="text/css" rel="stylesheet" href="css/style.css?<?php echo time(); ?>"  media="screen,projection"/>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  </head>

  <body id="login-page" class="valign-wrapper">
  <div class="container">
      <div class="valign-wrapper">
          <div class="card-panel" id="login" class="row">
            <div class="card-content white-text">
              <div class="row">
              <img src="img/EEI.png" class="login-logo">
            </div>
                <span class="card-title"><h5>EEI Corporation's Service Desk</h5></span>
            </div>
            <form method="post">
              <div class="row">
                <div class="input-field col s12" id="login">
                  <input id="userid" name="userid" type="text" class="validate">
                  <label for="userid" id="login">Userid</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input id="password" name="password" type="password" class="validate">
                  <label for="password" id="login">Password</label>
                </div>
              </div>
              <div class="row" id="controls">
                 <input type="checkbox" id="remember" name="remember" />
                 <label for="test5">Remember Me</label>
                 <a class="password-forgot" href"#!">Forgot Password?</a>
              </div>
              <div class="row">
                 <input class="waves-effect waves-light btn-login" id="button-login" name="submit" type="submit" value="Login">
                 <br>
              </div>
              </form>
            </div>
        </div>
    </div>

    <!--LOGIN PROCESS-->
    <?php
    include "templates/dbconfig.php";
    if(isset($_POST['userid']) && isset($_POST['password'])){
      $username = $_POST['userid'];
      $password = md5($_POST['password']);
      $stmt = $db->prepare("SELECT * FROM user_t WHERE userid=? AND password=? ");
      $stmt->bindParam(1, $username);
      $stmt->bindParam(2, $password);
      $stmt->execute();
      $row = $stmt->fetch();
      $user = $row['userid'];
      $pass = $row['password'];
      $id = $row['user_id'];
      $fname = $row['first_name'];
      $lname = $row['last_name'];
      $email = $row['email_address'];
      $user_type = $row['user_type'];
      $firstlogin = $row['is_firstlogin'];
      if($username==$user && $password==$pass){
        session_start();
        $_SESSION['userid'] = $user;
        $_SESSION['password'] = $pass;
        $_SESSION['user_id'] = $id;
        $_SESSION['user_type'] = $user_type;
        $_SESSION['first_name'] = $fname;
        $_SESSION['last_name'] = $lname;
        $_SESSION['email_address'] = $email;

        if($firstlogin === NULL){ ?>
          <?php
            $db = mysqli_connect("localhost", "root", "", "eei_db");
            $usersession = $_SESSION['userid'];
            $islogin = "UPDATE user_t SET is_firstlogin = true WHERE userid = '$usersession'";
            if (!mysqli_query($db, $islogin))
            {
              die('Error' . mysqli_error($db));
            }
            ?>
            <script>window.location.assign('changepassword.php')</script>

            <!-- <script>window.location.assign('changepassword.php')</script> -->
          <?php } else { ?>
            <script>window.location.assign('home.php')</script>

          <?php
          }}}
        ?>
    <!-- END OF LOGIN PROCESS -->


    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="js/materialize.min.js"></script>
    <script type="text/javascript" src="js/javascript.js"></script>
  </body>
</html>
