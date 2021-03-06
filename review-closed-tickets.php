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
    <?php include 'templates/sidenav.php'; ?>

    <!-- ****************************************************** -->

    <!--body-->
      <div class="col s12 m12 l10">
        <div class="wrapper">
          <div class="main-container">
            <div class="main-body">
            <div class="material-table">
              <table id="datatable" class="striped">
                <div class="table-header">
                  <span class="table-title"><b>Closed Tickets Reviewed</b></span>
                  <div class="count">
                  <!-- Badge Counter -->
                  <?php
                    $db = mysqli_connect("localhost", "root", "", "eei_db");
                    $query = "SELECT COUNT(t.ticket_id) AS count FROM ticket_t t LEFT JOIN user_t r ON t.user_id = r.user_id LEFT JOIN sla_t sev ON sev.id = t.severity_level LEFT JOIN ticket_status_t stat ON stat.status_id = t.ticket_status WHERE t.user_id = '".$_SESSION['user_id']."'";

                    $result = mysqli_query($db,$query); ?>

                    <?php while($row = mysqli_fetch_assoc($result)){ ?>
                      <span class="badge main-count"> <?php echo $row['count'] . " tickets" ?></span>
                    <?php } ?>
                  </div>
                </div>
                <div class="actions">
                  <div class="sorter">
                    <!-- Dropdown Trigger for New Ticket -->
                    <a class="dropdown-button btn-sort" data-activates="dropdown3" data-beloworigin="true">Category<i id="sort" class="material-icons">arrow_drop_down</i></a>
                    <!-- Dropdown Structure -->
                    <ul id="dropdown3" class="dropdown-content collection">
                        <li><a href="?view=technicals" class="technicals">Technicals</a></li>
                        <li><a href="?view=access" class="accesstickets">Access</a></li>
                        <li><a href="?view=network" class="network">Network</a></li>
                    </ul>
                    <!-- Dropdown Trigger for New Ticket -->
                      <a class="dropdown-button btn-sort" data-activates="dropdown4" data-beloworigin="true">Severity<i id="sort" class="material-icons">arrow_drop_down</i></a>
                    <!-- Dropdown Structure -->
                    <ul id="dropdown4" class="dropdown-content collection">
                        <li><a href="?view=sev1">SEV1</a></li>
                        <li><a href="?view=sev2">SEV2</a></li>
                        <li><a href="?view=sev3">SEV3</a></li>
                        <li><a href="?view=sev4">SEV4</a></li>
                        <li><a href="?view=sev5">SEV5</a></li>
                    </ul>
                    <a href="#" class="search-toggle waves-effect btn-search">Search</a>

                  </div>
                </div>

                </div>
                  <?php $db = mysqli_connect("localhost", "root", "", "eei_db"); {?>
                    <?php
                    if ($_SESSION['user_type']=='Administrator') {?>
                      <thead>
                        <tr>
                          <th></th>
                          <th>Ticket No.</th>
                          <th>Notes</th>
                          <th>Date Created</th>
                          <th>Remarks</th>
                        </tr>
                      </thead>
                    <tbody>
                    <?php
                    //automatic na naupdate ni zairra yung severity and category, pending na yung status
                     $query = "SELECT * FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id) LEFT JOIN sla_t sev ON sev.id = ticket_t.severity_level LEFT JOIN ticket_status_t stat ON stat.status_id = ticket_t.ticket_status WHERE ticket_t.ticket_status='Closed'";

                     $result = mysqli_query($db,$query);?>
                      <?php while($row = mysqli_fetch_assoc($result)){
                        switch($row['ticket_category'])
                         {
                             // assumes 'type' column is one of CAR | TRUCK | SUV
                             case("Technicals"):
                                 $class = 'ticket_cat_t';
                                 break;
                             case("Access"):
                                $class = 'ticket_cat_a';
                                break;
                             case("Network"):
                               $class = 'ticket_cat_n';
                               break;
                             case(""):
                               $class = 'ticket_cat_blank';
                               break;
                         }
                        ?>
                         <tr class='clickable-row' data-href="details.php?id=<?php echo $row['ticket_id']?>">
                           <td id="type"><span class="<?php echo $class?>"> <?php echo $row['ticket_category'][0]?></span><p style="margin-top:25px;margin-bottom:-5px;font-size:8pt;"><?php echo $row['severity_level']?></p></td>
                           <td> <?php echo $row['ticket_number']?>  </td>
                           <td> <?php echo $row['ticket_title']?>   </td>
                           <td> <?php echo $row['date_prepared']?>  </td>
                           <td> <?php echo $row['remarks'] ?>       </td>
                         </tr>
                        <?php
                      }}
                    elseif ($_SESSION['user_type']=='Access Group Manager') {?>
                      <thead>
                        <tr>
                          <th></th>
                          <th>Ticket No.</th>
                          <th>Status</th>
                          <th>Date Created</th>
                          <th>Department/Project</th>
                          <th>Access Requested</th>
                        </tr>
                      </thead>

                        <?php
                        $query = "SELECT * FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id) LEFT JOIN sla_t sev ON sev.id = ticket_t.severity_level LEFT JOIN ticket_status_t stat ON stat.status_id = ticket_t.ticket_status WHERE ticket_t.ticket_category='Access' AND stat.ticket_status='Closed'";
                        $result = mysqli_query($db,$query);?>

                        <?php while($row = mysqli_fetch_assoc($result)){
                          switch($row['ticket_category'])
                           {
                               // assumes 'type' column is one of CAR | TRUCK | SUV
                               case("Technicals"):
                                   $class = 'ticket_cat_t';
                                   break;
                               case("Access"):
                                  $class = 'ticket_cat_a';
                                  break;
                               case("Network"):
                                 $class = 'ticket_cat_n';
                                 break;
                               case(""):
                                 $class = 'ticket_cat_blank';
                                 break;
                           }
                          ?>

                           <tr class='clickable-row' data-href="details.php?id=<?php echo $row['ticket_id']?>">
                             <td id="type"><span class="<?php echo $class?>"> <?php echo $row['ticket_category'][0]?></span><p style="margin-top:25px;margin-bottom:-5px;font-size:8pt;"><?php echo $row['severity_level']?></p></td>
                             <td> <?php echo $row['ticket_number']?>  </td>
                             <td> <?php echo $row['ticket_status']?>  </td>
                             <td> <?php echo $row['date_created'] ?>  </td>
                             <td> <?php echo $row['dept_proj']?>   </td>
                             <td> <?php echo $row['access_requested']?>  </td>
                           </tr>
                  <?php
                    }}
                    elseif ($_SESSION['user_type']=='Technicals Group Manager') {?>
                      <thead>
                        <tr>
                          <th></th>
                          <th>Ticket No.</th>
                          <th>Status</th>
                          <th>Notes</th>
                          <th>Date Created</th>
                          <th>Remarks</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                        $query = "SELECT * FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id) LEFT JOIN sla_t sev ON sev.id = ticket_t.severity_level LEFT JOIN ticket_status_t stat ON stat.status_id = ticket_t.ticket_status WHERE ticket_t.ticket_category='Technicals' AND stat.ticket_status='Closed'";

                        $result = mysqli_query($db,$query);?>

                        <?php while($row = mysqli_fetch_assoc($result)){
                          switch($row['ticket_category'])
                           {
                               // assumes 'type' column is one of CAR | TRUCK | SUV
                               case("Technicals"):
                                   $class = 'ticket_cat_t';
                                   break;
                               case("Access"):
                                  $class = 'ticket_cat_a';
                                  break;
                               case("Network"):
                                 $class = 'ticket_cat_n';
                                 break;
                               case(""):
                                 $class = 'ticket_cat_blank';
                                 break;
                           }
                          ?>

                           <tr class='clickable-row' data-href="details.php?id=<?php echo $row['ticket_id']?>">
                             <td id="type"><span class="<?php echo $class?>"> <?php echo $row['ticket_category'][0]?></span><p style="margin-top:25px;margin-bottom:-5px;font-size:8pt;"><?php echo $row['severity_level']?></p></td>
                             <td> <?php echo $row['ticket_number']?>  </td>
                             <td> <?php echo $row['ticket_status']?>  </td>
                             <td> <?php echo $row['ticket_title']?>   </td>
                             <td> <?php echo $row['date_prepared']?>  </td>
                             <td> <?php echo $row['remarks'] ?>       </td>
                           </tr>
                          <?php
                        }}

                        elseif ($_SESSION['user_type']=='Network Group Manager') {?>
                          <thead>
                            <tr>
                              <th></th>
                              <th>Ticket No.</th>
                              <th>Status</th>
                              <th>Notes</th>
                              <th>Date Created</th>
                              <th>Remarks</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php
                            $query = "SELECT * FROM ticket_t LEFT JOIN user_access_ticket_t USING (ticket_id) LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN sla_t sev ON sev.id = ticket_t.severity_level LEFT JOIN ticket_status_t stat ON stat.status_id = ticket_t.ticket_status WHERE ticket_t.ticket_status='Closed' AND ticket_t.ticket_category='Network'";
                            $result = mysqli_query($db,$query);?>

                            <?php while($row = mysqli_fetch_assoc($result)){
                              switch($row['ticket_category'])
                               {
                                   // assumes 'type' column is one of CAR | TRUCK | SUV
                                   case("Technicals"):
                                       $class = 'ticket_cat_t';
                                       break;
                                   case("Access"):
                                      $class = 'ticket_cat_a';
                                      break;
                                   case("Network"):
                                     $class = 'ticket_cat_n';
                                     break;
                                   case(""):
                                     $class = 'ticket_cat_blank';
                                     break;
                               }
                              ?>

                               <tr class='clickable-row' data-href="details.php?id=<?php echo $row['ticket_id']?>">
                                 <td id="type"><span class="<?php echo $class?>"> <?php echo $row['ticket_category'][0]?></span><p style="margin-top:25px;margin-bottom:-5px;font-size:8pt;"><?php echo $row['severity_level']?></p></td>
                                 <td> <?php echo $row['ticket_number']?>  </td>
                                 <td> <?php echo $row['ticket_status']?>  </td>
                                 <td> <?php echo $row['ticket_title']?>   </td>
                                 <td> <?php echo $row['date_prepared']?>  </td>
                                 <td> <?php echo $row['remarks'] ?>       </td>
                               </tr>
                              <?php
                            }}

                    elseif ($_SESSION['user_type']=='Requestor') {?>
                      <thead>
                        <tr>
                          <th></th>
                          <th>Ticket No.</th>
                          <th>Status</th>
                          <th>Department/Project</th>
                          <th>Access Requested</th>
                          <th>Date Created</th>
                        </tr>
                      </thead>
                      <?php
                      $id = $_SESSION['user_id'];
                      $query = "SELECT * FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id) LEFT JOIN sla_t sev ON sev.id = ticket_t.severity_level LEFT JOIN ticket_status_t stat ON stat.status_id = ticket_t.ticket_status WHERE stat.ticket_status='Closed' AND (user_access_ticket_t.checker = $id OR user_access_ticket_t.approver=$id)";

                      $result = mysqli_query($db,$query);?>


                      <?php while($row = mysqli_fetch_assoc($result)){
                        switch($row['ticket_category'])
                         {
                             // assumes 'type' column is one of CAR | TRUCK | SUV
                             case("Technicals"):
                                 $class = 'ticket_cat_t';
                                 break;
                             case("Access"):
                                $class = 'ticket_cat_a';
                                break;
                             case("Network"):
                               $class = 'ticket_cat_n';
                               break;
                             case(""):
                               $class = 'ticket_cat_blank';
                               break;
                         }
                        ?>

                         <tr class='clickable-row' data-href="details.php?id=<?php echo $row['ticket_id']?>">
                           <td id="type"><span class="<?php echo $class?>"> <?php echo $row['ticket_category'][0]?></span><p style="margin-top:25px;margin-bottom:-5px;font-size:8pt;"><?php echo $row['severity_level']?></p></td>
                           <td> <?php echo $row['ticket_number']?>  </td>
                           <td> <?php echo $row['ticket_status']?>  </td>
                           <td> <?php echo $row['ticket_title']?>   </td>
                           <td> <?php echo $row['date_prepared']?>  </td>
                           <td> <?php echo $row['remarks'] ?>       </td>
                         </tr>
                          <?php
                        }}


                    elseif($_SESSION['user_type'] == 'Technician') {
                        $query = "SELECT * FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN sla_t sev ON sev.id = ticket_t.severity_level LEFT JOIN ticket_status_t stat ON stat.status_id = ticket_t.ticket_status WHERE ticket_t.ticket_agent_id = '".$_SESSION['user_id']."'";
                        ?>
                        <thead>
                          <tr>
                            <th></th>
                            <th>Ticket No.</th>
                            <th>Status</th>
                            <th>Notes</th>
                            <th>Date Created</th>
                            <th>Remarks</th>
                          </tr>
                        </thead>
                    <?php
                       $result = mysqli_query($db,$query);
                       while($row = mysqli_fetch_assoc($result)){
                          switch($row['ticket_category'])
                           {
                               // assumes 'type' column is one of CAR | TRUCK | SUV
                               case("Technicals"):
                                   $class = 'ticket_cat_t';
                                   break;
                               case("Access"):
                                  $class = 'ticket_cat_a';
                                  break;
                               case("Network"):
                                 $class = 'ticket_cat_n';
                                 break;
                               case(""):
                                 $class = 'ticket_cat_blank';
                                 break;
                           }?>

                         <tr class='clickable-row' data-href="details.php?id=<?php echo $row['ticket_id']?>">
                           <td id="type"><span class="<?php echo $class?>"> <?php echo $row['ticket_category'][0]?></span><p style="margin-top:25px;margin-bottom:-5px;font-size:8pt;"><?php echo $row['severity_level']?></p></td>
                           <td> <?php echo $row['ticket_number']?>  </td>
                           <td><span class="badge new"><?php echo $row['ticket_status']?>  </span></td>
                           <td> <?php echo $row['ticket_title']?>   </td>
                           <td> <?php echo $row['date_prepared']?>  </td>
                           <td> <?php echo $row['remarks'] ?>       </td>
                         </tr>
                       <?php }}



                       elseif($_SESSION['user_type'] == 'Network Engineer') {
                           $query = "SELECT * FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN sla_t sev ON sev.id = ticket_t.severity_level LEFT JOIN ticket_status_t stat ON stat.status_id = ticket_t.ticket_status WHERE ticket_t.ticket_agent_id = '".$_SESSION['user_id']."'";
                           ?>
                           <thead>
                             <tr>
                               <th></th>
                               <th>Ticket No.</th>
                               <th>Status</th>
                               <th>Notes</th>
                               <th>Date Created</th>
                               <th>Remarks</th>
                             </tr>
                           </thead>
                       <?php
                          $result = mysqli_query($db,$query);
                          while($row = mysqli_fetch_assoc($result)){
                             switch($row['ticket_category'])
                              {
                                  // assumes 'type' column is one of CAR | TRUCK | SUV
                                  case("Technicals"):
                                      $class = 'ticket_cat_t';
                                      break;
                                  case("Access"):
                                     $class = 'ticket_cat_a';
                                     break;
                                  case("Network"):
                                    $class = 'ticket_cat_n';
                                    break;
                                  case(""):
                                    $class = 'ticket_cat_blank';
                                    break;
                              }?>

                            <tr class='clickable-row' data-href="details.php?id=<?php echo $row['ticket_id']?>">
                              <td id="type"><span class="<?php echo $class?>"> <?php echo $row['ticket_category'][0]?></span><p style="margin-top:25px;margin-bottom:-5px;font-size:8pt;"><?php echo $row['severity_level']?></p></td>
                              <td> <?php echo $row['ticket_number']?>  </td>
                              <td><span class="badge new"><?php echo $row['ticket_status']?>  </span></td>
                              <td> <?php echo $row['ticket_title']?>   </td>
                              <td> <?php echo $row['date_prepared']?>  </td>
                              <td> <?php echo $row['remarks'] ?>       </td>
                            </tr>
                          <?php }}}?>

                </tbody>
              </table>
            </div>
          </div>
          <!-- HIDDEN FORMS --> <?php include 'templates/ticketforms.php'; ?>
        </div> <!-- End of main container of col 10 -->
      </div> <!-- End of wrapper of col l10 -->
    </div> <!-- END OF COL l10 -->
    <?php include 'templates/js_resources.php' ?>
  </body>
</html>
