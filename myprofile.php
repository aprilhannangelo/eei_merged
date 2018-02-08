<?php
  session_start();
  if(!isset($_SESSION['user_id'])){
    header('location: index.php');
  }
?>

<!DOCTYPE html>
<html>
<head>
  <?php include 'templates/css_resources.php' ?>
</head>

<body>
  <?php include 'templates/navheader.php'; ?>
  <?php include 'templates/sidenav.php'; ?>

  <!-- ****************************************************** -->

  <!--body-->
  <div class="col s12 m12 l10">
    <div class="wrapper">
      <div class="main-container">
        <div class="main-body">
          <input class="waves-effect waves-light submit" id="request-form" name="submit" type="submit" value="Edit">
          <h4 class="body-header"><b><?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name'] ?></b></h4>
          <h6 class="body-header" id="line2"><b><?php echo $_SESSION['user_type'] ?></b></h6>
          <hr>
          <br>
          <table id="profile">
            <tbody>
              <tr>
                <td>First Name</td>
                <td><?php echo $_SESSION['first_name']?></td>
              </tr>
              <tr>
                <td>Last Name</td>
                <td><?php echo $_SESSION['last_name']?></td>
              </tr>
              <tr>
                <td>Userid</td>
                <td><?php echo $_SESSION['userid']?></td>
              </tr>
              <tr>
                <td>E-mail Address</td>
                <td><?php echo $_SESSION['email_address']?></td>
              </tr>
              <tr>
                <td>User Type</td>
                <td><?php echo $_SESSION['user_type']?></td>
              </tr>
              <tr>
                <td>Requestor ID</td>
                <td><?php echo $_SESSION['user_id']?></td>
              </tr>
            </tbody>
          </table>
        </div>  <!-- end of main body div -->

      <!-- ****************************************************** -->

        <!-- HIDDEN FORMS -->
        <?php include 'templates/ticketforms.php'; ?>
      </div> <!-- End of main container of col 10 -->
    </div> <!-- End of wrapper of col l10 -->
  </div>
  <!-- END OF COL l10 -->
  <?php include 'templates/js_resources.php' ?>

</body>
</html>
