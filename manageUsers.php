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
              <div class="material-table" id="manage">
                <div class="table-header">
                  <span class="table-title"><b>Manage Users</b></span>
                  <div class="actions">
                    <a href="#" class="modal-trigger waves-effect btn-flat nopadding requestor"><i class="material-icons">person_add</i></a>
                    <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
                  </div>
                </div>
                <table id="datatable" class="manageUsers">
                  <thead>
                    <tr>
                      <th>Requestor Name</th>
                      <th>User ID</th>
                      <th>Email Address</th>
                      <th>User Type</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!--Connect to mysql database-->
                    <?php
                    $db = mysqli_connect("localhost", "root", "", "eei_db");
                    //Query for the way the table is shown in hr-index.php
                    $query = "SELECT * FROM user_t";


                    $result = mysqli_query($db,$query);
                    while ($row = mysqli_fetch_assoc($result)){
                    ?>

                      <tr class='clickable-row' data-href="profile.php?id=<?php echo $row['user_id']?>">
                            <td class = 'user-row'> <?php echo $row['first_name'] . ' ' . $row['last_name']?>  </td>
                            <td class = 'user-row'> <?php echo $row['userid']?>   </td>
                            <td class = 'user-row'> <?php echo $row['email_address']?>  </td>
                            <td class = 'user-row'> <?php echo $row['user_type']?> </td>
                          </tr>
                        <?php }?>
                  </tbody>
                </table>
              </div>
            </div>
            <!-- end of main body div -->

            <form id="requestor" name="requestor" method="post">
              <div id="requestor" class="requestort">
                <div class="search-bar"><h5 class="body-header"><b>New User</b></h5></div>
                <hr>
                  <div class="row">
                      <div class="col s12">
                        <div class="row">
                            <div class="col s12 l6" id="form">
                              <h6>User Details</h6>
                              <div class="row" id="request-form-row">
                                <div class="col s12">
                                  <div class="input-field" id="request-form">
                                    <input placeholder=" " class="userid" name="userid" type="text" data-length="40" class="validate" required>
                                    <label for="title">User ID</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row" id="request-form-row">
                                <div class="col s12">
                                  <div class="input-field" id="request-form">
                                    <input placeholder=" " class="fname" name="fname" type="text" data-length="40" class="validate" required>
                                    <label for="title">First Name</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row" id="request-form-row">
                                <div class="col s12">
                                  <div class="input-field" id="request-form">
                                    <input placeholder=" " class="lname" name="lname" type="text" data-length="40" class="validate" required>
                                    <label for="title">Last Name</label>
                                  </div>
                                </div>
                              </div>

                              <div class="row" id="request-form-row">
                                <div class="col s12">
                                  <div class="input-field" id="request-form">
                                    <input placeholder=" " class="email" name="email" type="text" data-length="40" class="validate" required>
                                    <label for="title">Email Address</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row" id="request-form-row">
                                <div class="col s12">
                                  <div class="input-field" id="request-form">
                                    <input  class="password" name="password" type="text" data-length="40" class="validate" >
                                    <label for="title">Password</label>
                                  </div>
                                </div>
                              </div>
                              <div class="row" id="request-form-row">
                                <div class="col s12">
                                  <div class="input-field" id="request-form">
                                    <?php
                                      $db = mysqli_connect("localhost", "root", "", "eei_db");?>

                                      <select name = "type" required>
                                      <option value= "">Select</option>
                                      <?php $get_user_type = mysqli_query($db, "SELECT column_type FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'user_t' AND COLUMN_NAME = 'user_type'");
                                      $row = mysqli_fetch_array($get_user_type);
                                      $enumList = explode(",", str_replace("'", "", substr($row['column_type'], 5, (strlen($row['column_type'])-6))));
                                      foreach($enumList as $value){?>
                                      <option value='<?php echo $value?>'> <?php echo $value?> </option>
                                          <?php } ?>
                                      </select>

                                  <label for="title">User Type</label>
                                  </div>
                                </div>
                              </div>

                                <div class="row">
                                  <input class="waves-effect waves-light submit" id="request-form" name="submit" type="submit" value="Submit">
                                  <input class="waves-effect waves-light cancel" id="request-form" name="submit" type="submit" value="Cancel">
                                </div>
                            </div>

                        </div>
                      </div>
                  </div>
                </div>
              </form>

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
