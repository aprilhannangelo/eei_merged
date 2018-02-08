<?php
  include "templates/dbconfig.php";
  session_start();
  if(!isset($_SESSION['userid'])){
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

  <!-- ****************************************************** -->

  <!--body-->
    <div class="col s12 m12 l10">
      <div class="wrapper">
        <?php include 'templates/sidenav.php'; ?>

        <div class="main-container">
          <div class="main-body">
            <div class="col s6 m6 l12">
              <div class="col s6 m6 l4">
               </div>
             </div>

            <div class="col s12 m12 l12">
              <div class="row">
                <div class="col s12 m12 l7">
                  <div class="card panel" id="detail-header">
                  <?php
                  $db = mysqli_connect("localhost", "root", "", "eei_db");

                    $query2 = "SELECT t.ticket_number, u.isChecked, u.isApproved, u.approver as approver,u.checker as checker FROM ticket_t t INNER JOIN user_t r  on (t.user_id=r.user_id) left join user_access_ticket_t u on (u.ticket_id=t.ticket_id) WHERE t.ticket_id = '".$_GET['id']."'";

                    $result2= mysqli_query($db,$query2);

                    while($row = mysqli_fetch_assoc($result2)){?>
                      <div class="header">
                       <?php echo "<input class=\"material-icons\" alt=\"Go back\" type=\"submit\" id=\"details-back\" value=\"arrow_back\" onclick=\"window.history.go(-1); return false;\">Ticket #" . $row['ticket_number'];
                       $id = $_SESSION['user_id'];
                       $ticketID =$_GET['id'];
                       ?>
                       <div class="row detail-actions">
                       <div class="row" id="activity-log">
                         <button class="btn-activitylog">Add activity log</button>
                       </div>
                       <input id="attach" type="submit" class="modal-trigger" href="#attachfile" value="Attach File">

                       <form id="cancel" name="cancel" method="post">
                         <input id="cancel" disabled type="submit" onclick="php_processes/cancel-process.php'" value="Cancel">
                         <input  id="cancel" name = "ticketID" type="hidden" value="<?php echo $ticketID?>">
                       </form>
                       <div class="approve-reject">
                         <?php
                           if ($row['approver']==$id) { ?>
                           <form id="approve" name="approve" method="post">
                             <input id="approve" type="submit" onclick="php_processes/approve-process.php'" value="Approve">
                             <input  id="approve" name = "ticketID" type="hidden" value="<?php echo $ticketID?>">
                           </form>
                           <form id="reject" name="reject" method="post">
                             <input id="reject" type="submit" onclick="php_processes/reject-process.php'" value="Reject">
                             <input  id="reject" name = "ticketID" type="hidden" value="<?php echo $ticketID?>">
                           </form>


                          <?php }
                          elseif ($row['checker']==$id) { ?>
                           <form id="check" name="check" method="post">
                           <input id="check" type="submit" onclick="php_processes/check-process.php'" value="Check" />
                           <input id="check" name = "ticketID" type="hidden" value="<?php echo $ticketID?>">
                          </form>
                          <form id="reject" name="reject" method="post">
                            <input id="reject" type="submit" onclick="php_processes/reject-process.php'" value="Reject">
                            <input  id="reject" name = "ticketID" type="hidden" value="<?php echo $ticketID?>">
                          </form>
                        <?php } ?>
                       </div>
                <?php };?>
                      </div>
                    </div>
                  </div>
                  <!-- Modal Structure -->
                 <div id="attachfile" class="modal">
                   <div class="modal-content">
                     <h5>Attach File to Ticket</h5>
                     <form method='post' name="attach" id="attach" enctype="multipart/form-data">
                     <label for="description_entered">Description of File:</label>
                     <input type="text" name="description_entered"/><br><br>
                     <!-- <input type="file" id="file" name="file"/> -->
                     <div class="file-field input-field">
                     <div class="btn-attach">
                       <span>SELECT File</span>
                       <input type="file" id="file" name="file"/>
                     </div>
                     <div class="file-path-wrapper">
                       <input class="file-path validate" type="text">
                     </div>
                   </div>
                  <!-- PHP PROCESS OF ATTACH -->
                  <?php
                  include "templates/dbconfig.php";
                  if(isset($_POST['submit'])){
                  $name= $_FILES['file']['name'];
                  $desc = $_POST['description_entered'];
                  $tmp_name= $_FILES['file']['tmp_name'];
                  $file = 'uploads/' .$_FILES['file']['name'];
                  $upload = move_uploaded_file($tmp_name, $file);
                  $uploader = $_SESSION['user_id'];
                  if($upload){
                    $add = $db->prepare("INSERT INTO attachment_t VALUES('',?,'$uploader','$ticketID','$desc')");
                    $add->bindParam(1,$name);
                    if($add->execute()){
                      ?>
                      <?php} else { ?>

                      <?php }
                  } else {} ?>
                   <!-- don't remove or else it will upload repeatedly when refreshed -->
                 <script>window.location='details.php?id=<?php echo $ticketID?>'</script><?php };?>
                  <!-- END OF PHP PROCESS OF ATTACH -->
                   </div>
                   <div class="modal-footer">
                     <button class="btn" type="submit" name="submit">Upload</button>
                     <a href="#!" class="btn modal-action modal-close">Close</a>
                     </form>
                   </div>
                 </div>

                  <div class="card-panel">
                    <span class="black-text">
                      <?php
                        $db = mysqli_connect("localhost", "root", "", "eei_db");

                        $query = "SELECT t.ticket_title, s.request_details, r.email_address as email, DATE_FORMAT(date_prepared, '%W %b %e %Y %r') as date_prepared, CONCAT(r.first_name, ' ', r.last_name) As requestor FROM ticket_t t INNER JOIN user_t r  on (t.user_id=r.user_id) left join service_ticket_t s on (s.ticket_id=t.ticket_id) WHERE s.ticket_id = '".$_GET['id']."'";
                        $query2 = "SELECT u.isChecked, u.isApproved, u.approver as approver,u.checker as checker,t.ticket_title, u.access_requested, u.dept_proj,DATE_FORMAT(date_prepared, '%W %M %e %Y') as date_prepared, CONCAT(r.first_name, ' ', r.last_name) As requestor , r.user_type as user_type FROM ticket_t t INNER JOIN user_t r  on (t.user_id=r.user_id) left join user_access_ticket_t u on (u.ticket_id=t.ticket_id) WHERE u.ticket_id = '".$_GET['id']."'";

                        $result = mysqli_query($db,$query);
                        $result2= mysqli_query($db,$query2);


                        while($row = mysqli_fetch_assoc($result)){
                            $email = $row['email'];
                           echo "<h5><b>" . $row['ticket_title'] . "</h5></b>" .
                                "<p id=\"requestor_details\">" . "<style=\"color:blue\">" . "<span class=\"name-in-ticket tooltipped\" data-position=\"right\" data-delay=\"50\" data-tooltip=\"$email\">" . $row['requestor'] . "</span>" . "<span class=\"request_date\">" . " reported on " . $row['date_prepared'] . "</p>" .
                                "<p id=\"details\">" . $row['request_details'] . "</p>";
                       };
                       while($row = mysqli_fetch_assoc($result2)){

                          echo "<h5><b>" . $row['ticket_title'] . "</h5></b>" .
                               "<p id=\"requestor_details\">" . "<style=\"color:blue\">" . "<span class=\"name-in-ticket\">" . $row['requestor'] . "</span>" . "<span class=\"request_date\">" . " reported on " . $row['date_prepared'] . "</p>" .
                               "<br> <p id=\"details\">" . $row['access_requested'] . "</p>";
                          }; ?>
                 </div>
                <br>
                   <div id="container">
                     <?php if ($_SESSION['user_type'] != 'Requestor'){ ?>
                      <div id="comment_logs" class="alog">
                        <?php
                        $db = mysqli_connect("localhost", "root", "", "eei_db");
                        $result = mysqli_query($db, "SELECT a.activity_log_details, DATE_FORMAT(a.timestamp, '%b %e %Y %r') as timestamp, a.logger, a.activity_log_id, CONCAT(r.first_name, ' ', r.last_name) AS user, t.ticket_id FROM activity_log_t a LEFT JOIN ticket_t t ON a.ticket_id = t.ticket_id LEFT JOIN user_t r ON r.user_id = a.logger WHERE t.ticket_id = '".$_GET['id']."' ORDER BY a.activity_log_id DESC");
                        $row_cnt = mysqli_num_rows($result);
                        if($row_cnt > 0){
                          while($row=mysqli_fetch_array($result)){
                              echo "<div class='card panel comments_content'>";
                              echo "<div class=\"row\" id=\"logs\">" .
                              "<div class=\"user\">" . $row['user'] . "</div>" .
                              "<div class=\"date_posted\">" . $row['timestamp'] . "</div>" .
                              "<div class=\"details\">" .  $row['activity_log_details'] . "</div>" .
                              "</div></div>";
                          }}
                          else { echo "There are no activity logs for this ticket.";};
                        ?>
                      </div>
                      <div class="comment_input">
                          <div class="row">
                            <form id="activity_log" method="POST">
                              <div class="row">
                               <div class="input-field col s12">
                                <input type="text" id="activity_log" name="comments" class="materialize-textarea" required>
                                <label for="activity_log">Log activity here</label>
                                <?php
                                  $db = mysqli_connect("localhost", "root", "", "eei_db");

                                  $query2 = "SELECT COUNT(*) as count, ticket_id FROM ticket_t WHERE ticket_id = '".$_GET['id']."'";

                                  $result2= mysqli_query($db,$query2);

                                  while($row = mysqli_fetch_assoc($result2)){
                                    // $logger = $_SESSION['user_id'];

                                    $ticketID = $row['ticket_id'];
                                  }
                                 ?>
                                 <div class="tprop"><input id="submit" class="waves-effect waves-light save" type="submit" name="submit" onclick="php_processes/activitylog_process.php'" value="Post" />
                                 <input id="post" name = "ticketID" type="hidden" value="<?php echo $ticketID?>"></div>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                        <?php   } ?>

                    </div>


       </div>

                <div class="col s12 m12 l5">
                  <?php if($_SESSION['user_type'] != 'Requestor'){
                    $db = mysqli_connect("localhost", "root", "", "eei_db");
                    $tagent = mysqli_query($db, "SELECT ticket_agent_id FROM ticket_t WHERE ticket_id = '".$_GET['id']."'");

                    if ($result = mysqli_fetch_array($tagent)){
                      if($result['ticket_agent_id'] === NULL){
                    ?>
                  <?php if($_SESSION['user_type'] == 'Technicals Group Manager'){ ?>
                    <div class="card-panel" id="ticket-properties">
                    <form id="assignee" name="properties" method="post">
                      <span id="panelheader"> Assign to Ticket Agent</h6></span>
                      <div class="tprop">
                        <input class="waves-effect waves-light save" id="request-form-row" name="submit" type="submit" value="Save">
                        <input value = "<?php echo $_GET['id']?>" class="title" name="id" type="hidden" data-length="40" class="validate" required>

                        <?php
                        $db = mysqli_connect("localhost", "root", "", "eei_db");

                        $query6 = "SELECT ticket_number FROM ticket_t WHERE ticket_id = '".$_GET['id']."'";

                        $result= mysqli_query($db,$query6);

                        while($row = mysqli_fetch_assoc($result)){
                          // $logger = $_SESSION['user_id'];

                          $ticketID = $row['ticket_number'];
                        }

                          ?>
                      </div>
                      <div id="properties" class="row " id="request-form-row">
                        <div class="col s12 m12 l12 properties-box" id="properties-box">
                          <div class="input-field ticket-properties" id="request-form">

                              <select name = "assignee" required >
                              <option value="">Select</option>
                                <?php
                                  $result = mysqli_query($db, "SELECT user_id, CONCAT(first_name, ' ', last_name) AS technician FROM user_t WHERE user_type = 'Technician'");

                                  while ($row = mysqli_fetch_array($result))
                                    {?>

                                        <option value='<?php echo $row['user_id']?>'> <?php echo $row['technician'] ?></option>;
                                        <?php
                                    } ?>
                                    </select>
                              <label for="title">Select Technician:</label>
                          </div>
                      </div>
                    </div>
                  </div>
                  </form>
                <?php } ?>
              <?php if($_SESSION['user_type'] == 'Network Group Manager'){ ?>
                <div class="card-panel" id="ticket-properties">
                <form id="assignee" name="properties" method="post">
                  <div class="tprop-header"><h6>Assign to Ticket Agent</h6></div>
                  <div class="tprop">
                    <input class="waves-effect waves-light save" id="request-form-row" name="submit" type="submit" value="Save">
                    <input value = "<?php echo $_GET['id']?>" class="title" name="id" type="hidden" data-length="40" class="validate" required>
                    <?php
                    $db = mysqli_connect("localhost", "root", "", "eei_db");

                    $query6 = "SELECT ticket_number FROM ticket_t WHERE ticket_id = '".$_GET['id']."'";

                    $result= mysqli_query($db,$query6);

                    while($row = mysqli_fetch_assoc($result)){
                      // $logger = $_SESSION['user_id'];

                      $ticketID = $row['ticket_number'];
                    }

                      ?>

                      <input id="post" name = "ticketID" type="hidden" value="<?php echo $ticketID?>">


                  </div>

                  <div id="properties" class="row " id="request-form-row">
                    <div class="col s12 m12 l12 properties-box" id="properties-box">
                      <div class="input-field ticket-properties" id="request-form">
                        <?php
                          $db = mysqli_connect("localhost", "root", "", "eei_db");
                          ?>

                          <select name = "assignee" required >
                          <option value="">Select</option>
                            <?php
                              $result = mysqli_query($db, "SELECT user_id, CONCAT(first_name, ' ', last_name) AS nengineer FROM user_t WHERE user_type = 'Network Engineer'");

                              while ($row = mysqli_fetch_array($result))
                                {?>
                                    <option value='<?php echo $row['user_id']?>'> <?php echo $row['nengineer'] ?></option>;
                                    <?php
                                } ?>

                                </select>
                          <label for="title">Select Network Engineer:</label>
                      </div>
                  </div>
                </div>
              </div>
            </form>
          <?php }}

        else { ?>

          <button class="btn-reassign" id="reassign-button">Re-assign this ticket</button><br><br>
          <div id="reassign">
            <?php if($_SESSION['user_type'] == 'Technicals Group Manager' OR $_SESSION['user_type'] == 'Technician'){ ?>
              <div class="card-panel" id="ticket-properties">
              <form id="assignee" name="properties" method="post">
                <span id="panelheader"> Assign to Ticket Agent</h6></span>
                <div class="tprop">
                  <input class="waves-effect waves-light save" id="request-form-row" name="submit" type="submit" value="Save">
                  <input value = "<?php echo $_GET['id']?>" class="title" name="id" type="hidden" data-length="40" class="validate" required>

                  <?php
                  $db = mysqli_connect("localhost", "root", "", "eei_db");

                  $query6 = "SELECT ticket_number FROM ticket_t WHERE ticket_id = '".$_GET['id']."'";

                  $result= mysqli_query($db,$query6);

                  while($row = mysqli_fetch_assoc($result)){
                    // $logger = $_SESSION['user_id'];

                    $ticketID = $row['ticket_number'];
                  }

                    ?>

                    <input id="post" name = "ticketID" type="hidden" value="<?php echo $ticketID?>">
                </div>
                <div id="properties" class="row " id="request-form-row">
                  <div class="col s12 m12 l12 properties-box" id="properties-box">
                    <div class="input-field ticket-properties" id="request-form">

                        <select name = "assignee" required >
                        <option value="">Select</option>
                          <?php
                            $result = mysqli_query($db, "SELECT user_id, CONCAT(first_name, ' ', last_name) AS technician FROM user_t WHERE user_type = 'Technician'");

                            while ($row = mysqli_fetch_array($result))
                              {?>

                                  <option value='<?php echo $row['user_id']?>'> <?php echo $row['technician'] ?></option>;
                                  <?php
                              } ?>
                              </select>
                        <label for="title">Select Technician:</label>
                    </div>
                </div>
              </div>
            </div>
            </form>
          <?php } ?>
        <?php if($_SESSION['user_type'] == 'Network Group Manager' OR $_SESSION['user_type'] == 'Network Engineer'){ ?>
          <div class="card-panel" id="ticket-properties">
          <form id="assignee" name="properties" method="post">
            <div class="tprop-header"><h6>Assign to Ticket Agent</h6></div>
            <div class="tprop">
              <input class="waves-effect waves-light save" id="request-form-row" name="submit" type="submit" value="Save">
              <input value = "<?php echo $_GET['id']?>" class="title" name="id" type="hidden" data-length="40" class="validate" required>
              <?php
              $db = mysqli_connect("localhost", "root", "", "eei_db");

              $query6 = "SELECT ticket_number FROM ticket_t WHERE ticket_id = '".$_GET['id']."'";

              $result= mysqli_query($db,$query6);

              while($row = mysqli_fetch_assoc($result)){
                $ticketID = $row['ticket_number'];
              } ?>

                <input id="post" name = "ticketID" type="hidden" value="<?php echo $ticketID?>">
            </div>

            <div id="properties" class="row " id="request-form-row">
              <div class="col s12 m12 l12 properties-box" id="properties-box">
                <div class="input-field ticket-properties" id="request-form">
                  <?php
                    $db = mysqli_connect("localhost", "root", "", "eei_db");
                    ?>

                    <select name = "assignee" required >
                    <option value="">Select</option>
                      <?php
                        $result = mysqli_query($db, "SELECT user_id, CONCAT(first_name, ' ', last_name) AS nengineer FROM user_t WHERE user_type = 'Network Engineer'");

                        while ($row = mysqli_fetch_array($result))
                          {?>
                              <option value='<?php echo $row['user_id']?>'> <?php echo $row['nengineer'] ?></option>;
                              <?php
                          } ?>

                          </select>
                    <label for="title">Select Network Engineer:</label>
                </div>
            </div>
          </div>
        </div>
      </form>
    <?php }?>
          </div>
        <?php }}}?>
                  <?php if($_SESSION['user_type'] == 'Administrator'){
                    $db = mysqli_connect("localhost", "root", "", "eei_db");
                    $sevcat = mysqli_query($db, "SELECT severity_level, ticket_category FROM ticket_t WHERE ticket_id = '".$_GET['id']."'");

                    if ($result = mysqli_fetch_array($sevcat)){
                      if($result['severity_level'] === NULL){
                    ?>
                      <div class="card-panel" id="ticket-properties">
                        <span class="black-text">
                             <form id="properties" name="properties" method="post">
                               <span id="panelheader">Assign Ticket Properties</span>
                               <div id="card-header">
                               <input class="waves-effect waves-light save" id="submit" name="submit" type="submit" value="Save">
                               <input value = "<?php echo $_GET['id']?>" class="title" name="id" type="hidden" data-length="40" class="validate" required>
                             </div>
                        </span>
                               <div id="properties" class="row " id="request-form-row">
                                 <div class="col s12 m12 l12 properties-box" id="properties-box">
                                   <div class="col s12 m6 l6">
                                     <div class="input-field ticket-properties" id="request-form">
                                       <?php
                                         $db = mysqli_connect("localhost", "root", "", "eei_db");?>

                                         <select name = "category" required>
                                         <option disabled selected>Select</option>
                                         <?php $get_user_type = mysqli_query($db, "SELECT column_type FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'ticket_t' AND COLUMN_NAME = 'ticket_category'");
                                         $row = mysqli_fetch_array($get_user_type);
                                         $enumList = explode(",", str_replace("'", "", substr($row['column_type'], 5, (strlen($row['column_type'])-6))));
                                         foreach($enumList as $value){?>
                                         <option value='<?php echo $value?>'> <?php echo $value?> </option>
                                             <?php } ?>
                                         </select>
                                         <label for="title">Category</label>
                                     </div>
                                   </div>
                                   <div class="col s12 m6 l6">
                                     <div class="input-field ticket-properties" id="request-form">
                                       <?php
                                         $db = mysqli_connect("localhost", "root", "", "eei_db");?>
                                         <select name='severity'>
                                           <option disabled selected>Select</option>
                                         <?php
                                          $get_sevlvl = "SELECT * FROM sla_t";
                                          $result = mysqli_query($db, $get_sevlvl);
                                           while ($row = mysqli_fetch_assoc($result)) {
                                              ?>
                                              <option value="<?php echo $row['id']?>"> <?php echo $row['severity_level']?> </option>
                                           <?php }; ?>
                                          </select>
                                         <label for="title">Severity</label>
                                     </div>
                                   </div>
                                 </div>
                               </div>
                           </form>
                        </span>
                     </div>
                   <?php }}} ?>

                  <div class="card-panel" id="right-card">
                    <span class="black-text">
                      <span id="panelheader">Ticket Properties</span>

                      <?php if($_SESSION['user_type'] != 'Requestor'){
                      $db = mysqli_connect("localhost", "root", "", "eei_db");
                      $sevcat = mysqli_query($db, "SELECT severity_level, ticket_category FROM ticket_t WHERE ticket_id = '".$_GET['id']."'");

                      if ($result = mysqli_fetch_array($sevcat)){
                        if($result['severity_level'] != NULL){ ?>
                      <!-- Modal Trigger -->
                      <a class="waves-effect waves-light modal-trigger" href="#modal1"><i id="edit" class="small material-icons">edit</i></a>
                    <?php }}} ?>
                      <!-- Modal Structure -->
                      <div id="modal1" class="modal modal-fixed-footer">
                        <div class="modal-content">
                          <h6>Edit Ticket Properties</h6>
                          <form id="edit-properties" name="edit-properties" method="post">
                            <div class="col s12 m12 l12 properties-box" id="properties-box">
                              <div class="input-field ticket-properties" id="request-form-row2">
                                <?php
                                  $db = mysqli_connect("localhost", "root", "", "eei_db");?>

                                  <?php $retrieve = mysqli_query($db, "SELECT * FROM ticket_t LEFT JOIN ticket_status_t stat ON stat.status_id = ticket_t.ticket_status LEFT JOIN sla_t sev ON sev.id = ticket_t.severity_level WHERE ticket_id = '".$_GET['id']."'");
                                  $row = mysqli_fetch_array($retrieve);?>

                                  <select name = "status" required>
                                  <option selected disabled><?php echo $row['ticket_status']?></option>
                                  <?php $get_stat = "SELECT * FROM ticket_status_t WHERE status_id >= '5'";
                                  $result = mysqli_query($db, $get_stat);
                                    while ($row = mysqli_fetch_assoc($result)) {?>
                                      <option value='<?php echo $row['status_id']?>'> <?php echo $row['ticket_status']?></option>
                                    <?php } ?>
                                    </select>

                                  <label for="title">Ticket Status</label>
                              </div>
                              <div class="input-field ticket-properties" id="request-form-row2">
                                <?php
                                  $db = mysqli_connect("localhost", "root", "", "eei_db");?>

                                  <?php $retrieve = mysqli_query($db, "SELECT ticket_status, ticket_category, severity_level FROM ticket_t WHERE ticket_id = '".$_GET['id']."'");
                                  $row = mysqli_fetch_array($retrieve);?>

                                  <select name = "category" required>
                                  <option disabled selected><?php echo $row['ticket_category']?></option>
                                  <?php $get_user_type = mysqli_query($db, "SELECT column_type FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'ticket_t' AND COLUMN_NAME = 'ticket_category'");
                                  $row = mysqli_fetch_array($get_user_type);
                                  $enumList = explode(",", str_replace("'", "", substr($row['column_type'], 5, (strlen($row['column_type'])-6))));
                                  foreach($enumList as $value){?>
                                  <option value='<?php echo $value?>'> <?php echo $value?> </option>
                                      <?php } ?>
                                  </select>
                                  <label for="title">Ticket Category</label>
                              </div>
                              <div class="input-field ticket-properties" id="request-form-row2">
                                  <?php
                                    $db = mysqli_connect("localhost", "root", "", "eei_db");?>

                                    <?php $retrieve = mysqli_query($db, "SELECT * FROM ticket_t LEFT JOIN ticket_status_t stat ON stat.status_id = ticket_t.ticket_status LEFT JOIN sla_t sev ON sev.id = ticket_t.severity_level WHERE ticket_id = '".$_GET['id']."'");
                                    $row = mysqli_fetch_array($retrieve);?>

                                    <?php
                                      $db = mysqli_connect("localhost", "root", "", "eei_db");


                                      ?>
                                      <select name='severity'>
                                        <option disabled selected><?php echo $row['severity_level']?></option>
                                      <?php
                                       $get_sevlvl = "SELECT * FROM sla_t";
                                       $result = mysqli_query($db, $get_sevlvl);
                                        while ($row = mysqli_fetch_assoc($result)) {
                                          ?>
                                           <option class="<?php echo $class ?>" value='<?php echo $row['id']?>'> <?php echo $row['severity_level']?> </option>
                                        <?php }; ?>
                                       </select>
                                      <label for="title">Severity Level</label>
                              </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                          <input class="modal-action modal-close btn-flat" id="request-form-row" name="submit" type="submit" value="Save">
                          <input value = "<?php echo $_GET['id']?>" name="id" type="hidden">
                        </div>
                      </form>
                      </div>
                      <table id="ticket-details">
                        <tbody>
                            <?php
                            $db = mysqli_connect("localhost", "root", "", "eei_db");

                              $query = "SELECT stat.ticket_status, sev.description, sev.severity_level, t.ticket_category, t.date_required FROM ticket_t t LEFT JOIN sla_t sev ON t.severity_level = sev.id LEFT JOIN ticket_status_t stat ON stat.status_id = t.ticket_status WHERE ticket_id = '".$_GET['id']."'";

                              $result = mysqli_query($db,$query);

                              while($row = mysqli_fetch_assoc($result)){
                                switch($row['severity_level'])
                                {
                                    // assumes 'type' column is one of CAR | TRUCK | SUV
                                    case("SEV1"):
                                        $class = 'sev1';
                                        break;

                                   case("SEV2"):
                                       $class = 'sev2';
                                       break;

                                   case("SEV3"):
                                       $class = 'sev3';
                                       break;

                                   case("SEV4"):
                                       $class = 'sev4';
                                       break;

                                   case("SEV5"):
                                       $class = 'sev5';
                                       break;

                                  case(""):
                                      $class = 'blanksev';
                                      break;
                                }


                                echo "<tr><td class=\"first\">" . "Category" . "</td><td>"  . $row['ticket_category']  . "</td>" .
                                     "<tr><td class=\"first\">" . "Status" .  "</td><td><span class=\"badge new\">" . $row['ticket_status'] . "</span></td>" .
                                     "<tr><td class=\"first\">" . "Severity" . "</td><td class=\"$class\" id=\"sev\">"  . $row['severity_level']  . " - " . $row['description'] . "</td>" .
                                     "<tr><td class=\"first\">" . "Due on" . "</td><td class=\"deet\">" .  $row['date_required'] . "</td>";
                             }
                            ?>
                          </tbody>
                        </table>
                  </div>
                  <div class="card-panel" id="right-card">
                    <span class="black-text">
                          <span id="panelheader">Ticket Details</span>
                          <table id="ticket-details">
                            <tbody>
                                <?php
                                $db = mysqli_connect("localhost", "root", "", "eei_db");

                                $query = "SELECT CONCAT(r.first_name, ' ', r.last_name) As requestor , r.email_address AS email FROM ticket_t t INNER JOIN user_t r  on (t.user_id=r.user_id) WHERE t.ticket_id = '".$_GET['id']."'";
                                $result = mysqli_query($db,$query);

                                  while($row = mysqli_fetch_assoc($result)){

                                  echo "<tr><td class=\"first\">" . "Requestor" . "</td><td class=\"user\">"  . $row['requestor']  . "</td>" .
                                         "<tr><td class=\"first\">" . "</td><td class=\"details\">" . $row['email'] . "</td></tr>" .
                                         "<tr><td><br></td></tr>";
                                  }

                                $query2 = "SELECT CONCAT(r.first_name, r.last_name) AS approver, r.email_address AS email FROM user_t r LEFT JOIN user_access_ticket_t U ON r.user_id = u.approver WHERE u.ticket_id = '".$_GET['id']."'";
                                $result2 = mysqli_query($db,$query2);

                                   while($row2 = mysqli_fetch_assoc($result2)){

                                   echo "<br><tr><td class=\"first\">" . "Approver" . "</td><td class=\"user\">"  . $row2['approver']  . "</td>" .
                                          "<tr><td class=\"first\">" . "</td><td class=\"details\">" . $row2['email'] . "</td></tr>" .
                                          "<tr><td><br></td></tr>";
                                   }

                                $query3 = "SELECT CONCAT(r.first_name, r.last_name) AS checker, r.email_address AS email FROM user_t r LEFT JOIN user_access_ticket_t U ON r.user_id = u.checker WHERE u.ticket_id = '".$_GET['id']."'";
                                $result3 = mysqli_query($db,$query3);

                                  while($row3 = mysqli_fetch_assoc($result3)){

                                  echo "<tr><td class=\"first\">" . "Checker" . "</td><td class=\"user\">"  . $row3['checker']  . "</td>" .
                                         "<tr><td class=\"first\">" . "</td><td class=\"details\">" . $row3['email'] . "</td></tr>" .
                                         "<tr><td><br></td></tr>";
                                  }

                                $query4 = "SELECT CONCAT(r.first_name, r.last_name) AS tagent, r.email_address AS email FROM user_t r LEFT JOIN ticket_t t ON r.user_id =t.ticket_agent_id WHERE t.ticket_id = '".$_GET['id']."'";
                                $result4 = mysqli_query($db,$query4);

                                  while($row4 = mysqli_fetch_assoc($result4)){

                                  echo "<tr><td class=\"first\">" . "Ticket Agent" . "</td><td class=\"user\">"  . $row4['tagent']  . "</td>" .
                                         "<tr><td class=\"first\">" . "</td><td class=\"details\">"  . $row4['email'] . "</td></tr>" .
                                         "<tr><td><br></td></tr>";
                                  }
                                ?>
                              </tbody>
                            </table>
                </div>
                <div class="card-panel" id="right-card">
                  <span class="black-text">
                        <span id="panelheader">File Attachments<br></span>
                        <table id="ticket-details">
                          <tbody>

                            <?php
                            $db = mysqli_connect("localhost", "root", "", "eei_db");
                            $ticketID = $_GET['id'];

                            $query = "SELECT * FROM attachment_t WHERE ticket_id = $ticketID";
                            $result = mysqli_query($db,$query);
                              while($row = mysqli_fetch_assoc($result)){?>
                              <a target="_blank" href="<?php echo 'uploads/' . $row['file']?>"><?php echo $row['file']?></a><br>
                            <?php } ?>
                            </tbody>
                          </table>
              </div>
              </div>
            </div>
          </div><!-- end div of row -->
        </div><!-- end div of main body -->

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
