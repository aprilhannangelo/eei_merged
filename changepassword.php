<!DOCTYPE html>
<html>
  <head>
    <?php include 'templates/css_resources.php'; ?>
  </head>

  <body id="login-page" class="valign-wrapper">
  <div class="container">
      <div class="valign-wrapper">
          <div class="card-panel" id="login" class="row">
            <div class="card-content white-text">
              <div class="row">
              <img src="img/EEI.png" class="login-logo">
            </div>
                <span class="card-title"><h5>Update Your Password</h5></span>
            </div>
            <form method="post" name="changep" id="changep">
              <br>
              <div class="row">
                <div class="input-field col s12" id="login">
                  <input id="newpass" name="newpass" type="password" class="validate">
                  <label for="newpass" id="newpass">New Password</label>
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input id="confirmnewpass" name="confirmnewpass" type="password" class="validate">
                  <label for="confirmnewpass" id="confirmnewpass">Confirm New Password</label>
                </div>
              </div>
              <div class="row">
                <br>
                 <input class="waves-effect waves-light btn-login" id="button-login" name="submit" type="submit" value="Update Password">
                 <input value = "<?php echo $_SESSION['userid']?>" name="userid" type="hidden">
              </div>
              </form>
            </div>
        </div>
    </div>

    <?php
    session_start();
    $db = mysqli_connect("localhost", "root", "", "eei_db");
    if(isset($_POST['newpass']) && isset($_POST['confirmnewpass'])){

    $newpass = $_POST['newpass'];
    $confirmnewpass = $_POST['confirmnewpass'];
    $session = $_SESSION['userid'];

    if($newpass === $confirmnewpass){
      $query = "UPDATE user_t SET password = MD5('$newpass') WHERE userid = '$session'";
      if (!mysqli_query($db, $query))
      {
        die('Error' . mysqli_error($db));
      }else{
        echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
        echo '<script type="text/javascript">';
        echo 'setTimeout(function () { swal("Success!","Your password has been updated!","success").then(function(){window.location="../eei/home.php";})';
        echo '});</script>';
      }}

    else{
    echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';
    echo '<script type="text/javascript">';
    echo 'setTimeout(function () { swal("Error!","Passwords not matching!","error");';
    echo '});</script>';
    }}
    ?>

    <?php include 'templates/js_resources.php'; ?>


  </body>
</html>
