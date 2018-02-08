<!-- Side Navigation -->
<div class="col s12 m12 l2">
    <!-- Slideout Navigation -->
    <ul id="slide-out" class="side-nav fixed">
      <li><a class="waves-effect" href="home.php"><i class="tiny material-icons">home</i>Home</a></li>
      <ul class="collapsible collapsible-accordion">
        <li>
          <a class="collapsible-header waves-effect tooltipped" data-position="right" data-delay="50" data-tooltip="Tickets I submitted" href="#!"><i class="tiny material-icons">receipt</i>My Tickets</a>
          <div class="collapsible-body">
            <ul>
              <li class="collapsible"><a class="all" href="my-tickets.php">All Tickets
                <!-- Badge Counter -->
                <?php
                  $db = mysqli_connect("localhost", "root", "", "eei_db");
                  $query = "SELECT COUNT(t.ticket_id) AS count FROM ticket_t t LEFT JOIN user_t r ON t.user_id = r.user_id LEFT JOIN sla_t sev ON sev.id = t.severity_level LEFT JOIN ticket_status_t stat ON stat.status_id = t.ticket_status WHERE t.user_id = '".$_SESSION['user_id']."'";

                  $result = mysqli_query($db,$query); ?>

                  <?php while($row = mysqli_fetch_assoc($result)){ ?>
                    <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                  <?php } ?>
              </a></li>

              <li class="collapsible"><a class="inprogress" href="my-inprogress-tickets.php">In Progress
                <!-- Badge Counter -->
                <?php
                  $db = mysqli_connect("localhost", "root", "", "eei_db");
                  $query = "SELECT COUNT(t.ticket_id) AS count FROM ticket_t t LEFT JOIN user_t r ON t.user_id = r.user_id LEFT JOIN sla_t sev ON sev.id = t.severity_level LEFT JOIN ticket_status_t stat ON stat.status_id = t.ticket_status WHERE stat.ticket_status='In Progress' AND t.user_id = '".$_SESSION['user_id']."'";

                  $result = mysqli_query($db,$query); ?>

                  <?php while($row = mysqli_fetch_assoc($result)){ ?>
                    <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                  <?php } ?>
              </a></li>

              <li class="collapsible"><a class="pending" href="my-pending-tickets.php">Pending
                <!-- Badge Counter -->
                <?php
                  $db = mysqli_connect("localhost", "root", "", "eei_db");
                  $query = "SELECT COUNT(t.ticket_id) AS count FROM ticket_t t LEFT JOIN user_t r ON t.user_id = r.user_id LEFT JOIN sla_t sev ON sev.id = t.severity_level LEFT JOIN ticket_status_t stat ON stat.status_id = t.ticket_status WHERE stat.ticket_status='Pending' AND t.user_id = '".$_SESSION['user_id']."'";

                  $result = mysqli_query($db,$query); ?>

                  <?php while($row = mysqli_fetch_assoc($result)){ ?>
                    <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                  <?php } ?>

                  <li class="collapsible"><a class="resolved" href="my-resolved-tickets.php">Resolved
                    <!-- Badge Counter -->
                    <?php
                      $db = mysqli_connect("localhost", "root", "", "eei_db");
                      $query = "SELECT COUNT(t.ticket_id) AS count FROM ticket_t t LEFT JOIN user_t r ON t.user_id = r.user_id LEFT JOIN sla_t sev ON sev.id = t.severity_level LEFT JOIN ticket_status_t stat ON stat.status_id = t.ticket_status WHERE stat.ticket_status='Resolved' AND t.user_id = '".$_SESSION['user_id']."'";

                      $result = mysqli_query($db,$query); ?>

                      <?php while($row = mysqli_fetch_assoc($result)){ ?>
                        <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                      <?php } ?>
                  </a></li>

                  <li class="collapsible"><a class="all" href="my-closed-tickets.php">Closed
                    <!-- Badge Counter -->
                    <?php
                      $db = mysqli_connect("localhost", "root", "", "eei_db");
                      $query = "SELECT COUNT(t.ticket_id) AS count FROM ticket_t t LEFT JOIN user_t r ON t.user_id = r.user_id LEFT JOIN sla_t sev ON sev.id = t.severity_level LEFT JOIN ticket_status_t stat ON stat.status_id = t.ticket_status WHERE stat.ticket_status='Closed' AND t.user_id = '".$_SESSION['user_id']."'";

                      $result = mysqli_query($db,$query); ?>

                      <?php while($row = mysqli_fetch_assoc($result)){ ?>
                        <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                      <?php } ?>
                  </a></li>
            </ul>
          </div> <!-- End of div collapsible body -->
        </li>
      </ul> <!-- End of div My Tickets accrodion -->

      <?php if($_SESSION['user_type'] == 'Administrator'){ ?>
        <ul class="collapsible collapsible-accordion">
          <li>
            <a class="collapsible-header tooltipped" data-position="right" data-delay="50" data-tooltip="Tickets of all requestors"  href="#!"><i class="tiny material-icons">view_list</i>Tickets for Review</a>
            <div class="collapsible-body">
              <ul>
                <li class="collapsible"><a href="review-tickets.php">Reviewed
                <?php $db = mysqli_connect("localhost", "root", "", "eei_db");{
                  $id = $_SESSION['user_id'];

                $query = "SELECT COUNT(ticket_t.ticket_id) AS count FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id) LEFT JOIN sla_t sev ON sev.id = ticket_t.severity_level LEFT JOIN ticket_status_t stat ON stat.status_id = ticket_t.ticket_status WHERE (ticket_t.ticket_category is NOT NULL AND ticket_t.severity_level is NOT NULL)";

                $result = mysqli_query($db,$query); ?>
                  <?php while($row = mysqli_fetch_assoc($result)){ ?>
                    <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                  <?php }} ?>
                </a></li>
                <li class="collapsible"><a href="review-incoming-tickets.php">Incoming
                  <?php $db = mysqli_connect("localhost", "root", "", "eei_db");{
                    $id = $_SESSION['user_id'];

                  $query = "SELECT COUNT(ticket_t.ticket_id) AS count FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id) LEFT JOIN sla_t sev ON sev.id = ticket_t.severity_level LEFT JOIN ticket_status_t stat ON stat.status_id = ticket_t.ticket_status WHERE (ticket_t.ticket_category is NULL AND ticket_t.severity_level is NULL AND ticket_t.ticket_type ='Service') OR (ticket_t.ticket_category is NULL AND ticket_t.severity_level is NULL AND user_access_ticket_t.isApproved=true)";

                  $result = mysqli_query($db,$query); ?>
                    <?php while($row = mysqli_fetch_assoc($result)){ ?>
                      <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                    <?php }} ?>
                </a></li>



                <!-- <li class="collapsible"><a href="review-pending-tickets.php">Pending
                  <?php $db = mysqli_connect("localhost", "root", "", "eei_db");{
                    $id = $_SESSION['user_id'];

                  //No other conditions since given na na kapag Pending, it means naassign na yung severity level and ticket
                  $query = "SELECT COUNT(ticket_t.ticket_id) AS count FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id) LEFT JOIN sla_t sev ON sev.id = ticket_t.severity_level LEFT JOIN ticket_status_t stat ON stat.status_id = ticket_t.ticket_status WHERE stat.ticket_status='Pending'";


                  $result = mysqli_query($db,$query); ?>
                    <?php while($row = mysqli_fetch_assoc($result)){ ?>
                      <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                    <?php }} ?>
                </a></li> -->

                <li class="collapsible"><a href="review-inprogress-tickets.php">In Progress
                <?php $db = mysqli_connect("localhost", "root", "", "eei_db");{
                  $id = $_SESSION['user_id'];

                $query = "SELECT COUNT(ticket_t.ticket_id) AS count FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id) LEFT JOIN sla_t sev ON sev.id = ticket_t.severity_level LEFT JOIN ticket_status_t stat ON stat.status_id = ticket_t.ticket_status WHERE stat.ticket_status='In Progress'";

                $result = mysqli_query($db,$query); ?>
                  <?php while($row = mysqli_fetch_assoc($result)){ ?>
                    <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                  <?php }} ?>
                </a></li>

                <li class="collapsible"><a href="review-resolved-tickets.php">Resolved
                <?php $db = mysqli_connect("localhost", "root", "", "eei_db");{
                  $id = $_SESSION['user_id'];

                $query = "SELECT COUNT(ticket_t.ticket_id) AS count FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id) LEFT JOIN sla_t sev ON sev.id = ticket_t.severity_level LEFT JOIN ticket_status_t stat ON stat.status_id = ticket_t.ticket_status WHERE stat.ticket_status='Resolved'";

                $result = mysqli_query($db,$query); ?>
                  <?php while($row = mysqli_fetch_assoc($result)){ ?>
                    <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                  <?php }} ?>
                </a></li>

                <li class="collapsible"><a href="review-closed-tickets.php">Closed
                <?php $db = mysqli_connect("localhost", "root", "", "eei_db");{
                  $id = $_SESSION['user_id'];

                $query = "SELECT COUNT(ticket_t.ticket_id) AS count FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id) LEFT JOIN sla_t sev ON sev.id = ticket_t.severity_level LEFT JOIN ticket_status_t stat ON stat.status_id = ticket_t.ticket_status WHERE stat.ticket_status='Closed'";

                $result = mysqli_query($db,$query); ?>
                  <?php while($row = mysqli_fetch_assoc($result)){ ?>
                    <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                  <?php }} ?>
                </a></li>
              </ul>
            </div>
          </li>
        </ul>

      <?php } elseif($_SESSION['user_type'] == 'Requestor'){ ?>
        <ul class="collapsible collapsible-accordion">
          <li>
            <a class="collapsible-header tooltipped" data-position="right" data-delay="50" data-tooltip="Tickets assigned to me"  href="#!"><i class="tiny material-icons">hourglass_full</i>Requests for Review</a>
            <div class="collapsible-body">
              <ul>
                <li class="collapsible"><a href="review-incoming-tickets.php">Incoming
                <?php
                  $db = mysqli_connect("localhost", "root", "", "eei_db");{
                    $id = $_SESSION['user_id'];

                    if ($_SESSION['user_type']=='Access Group Manager'){
                      //Pending Access tickets
                     $query = "SELECT COUNT(ticket_t.ticket_id)  AS count FROM ticket_t LEFT JOIN user_access_ticket_t USING (ticket_id)  LEFT JOIN ticket_status_t stat ON stat.status_id = ticket_t.ticket_status WHERE ticket_t.ticket_category='Access' AND stat.ticket_status='Pending'";

                      $result = mysqli_query($db,$query); ?>
                        <?php while($row = mysqli_fetch_assoc($result)){ ?>
                          <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                        <?php } ?>
                      <?php } elseif ($_SESSION['user_type']=='Technicals Group Manager') {

                      $query = "SELECT COUNT(ticket_t.ticket_id) AS count  FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) WHERE ticket_t.ticket_category='Technicals' AND ticket_t.ticket_agent_id IS NULL";

                       $result = mysqli_query($db,$query); ?>
                         <?php while($row = mysqli_fetch_assoc($result)){ ?>
                           <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                         <?php } ?>
                       <?php } elseif ($_SESSION['user_type']=='Requestor') {

                     $query = "SELECT COUNT(ticket_t.ticket_id) AS count FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id) WHERE (user_access_ticket_t.checker =$id AND user_access_ticket_t.isChecked is NULL) OR (user_access_ticket_t.approver=$id AND user_access_ticket_t.isChecked=true AND user_access_ticket_t.isApproved IS NULL)";

                      $result = mysqli_query($db,$query); ?>
                      <?php while($row = mysqli_fetch_assoc($result)){ ?>
                        <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                      <?php }}?>
                  <?php } ?>
                </a></li>

                <li class="collapsible"><a href="approvedRequests.php">Approved
                  <!-- Badge Counter -->
                  <?php
                    $db = mysqli_connect("localhost", "root", "", "eei_db");

                    $id = $_SESSION['user_id'];
                    $query = "SELECT COUNT(*) as count FROM ticket_t LEFT JOIN user_access_ticket_t USING (ticket_id)
                              WHERE (user_access_ticket_t.approver = $id AND user_access_ticket_t.isApproved = true)";
                    $result = mysqli_query($db,$query); ?>

                    <?php while($row = mysqli_fetch_assoc($result)){ ?>
                      <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                    <?php } ?>
                </a></li>

                <li class="collapsible"><a href="checkedRequests.php">Checked
                  <!-- Badge Counter -->
                  <?php
                    $db = mysqli_connect("localhost", "root", "", "eei_db");

                    $id = $_SESSION['user_id'];
                    $query = "SELECT COUNT(*) AS count FROM ticket_t LEFT JOIN user_access_ticket_t USING (ticket_id)
                              WHERE (user_access_ticket_t.checker = $id AND user_access_ticket_t.isChecked = true)";

                    $result = mysqli_query($db,$query); ?>

                    <?php while($row = mysqli_fetch_assoc($result)){ ?>
                      <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                    <?php } ?>
                </a></li>
              </ul>
            </div>
          </li>
        </ul>

      <?php } elseif($_SESSION['user_type'] == 'Technicals Group Manager'){ ?>
        <ul class="collapsible collapsible-accordion">
          <li>
            <a class="collapsible-header tooltipped" data-position="right" data-delay="50" data-tooltip="Tickets of my team"  href="#!"><i class="tiny material-icons">phonelink_setup</i>Technicals Tickets</a>
            <div class="collapsible-body">
              <ul>
                <li class="collapsible"><a href="review-incoming-tickets.php">Incoming
                  <?php
                    $db = mysqli_connect("localhost", "root", "", "eei_db");{
                      $id = $_SESSION['user_id'];

                      $query = "SELECT COUNT(ticket_t.ticket_id)  AS count FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id)  WHERE ticket_t.ticket_category='Technicals' AND ticket_t.ticket_agent_id IS NULL";

                      $result = mysqli_query($db,$query); ?>
                        <?php while($row = mysqli_fetch_assoc($result)){ ?>
                          <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                  <?php }} ?>
                </a></li>
                <li class="collapsible"><a href="review-tickets.php">All
                  <?php
                    $db = mysqli_connect("localhost", "root", "", "eei_db");{
                      $id = $_SESSION['user_id'];

                      $query = "SELECT COUNT(ticket_t.ticket_id)  AS count FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) WHERE ticket_t.ticket_category='Technicals' AND ticket_t.ticket_agent_id IS NOT NULL";

                      $result = mysqli_query($db,$query); ?>
                        <?php while($row = mysqli_fetch_assoc($result)){ ?>
                          <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                  <?php }} ?>
                </a></li>
                <li class="collapsible"><a href="review-inprogress-tickets.php">In Progress
                  <?php
                    $db = mysqli_connect("localhost", "root", "", "eei_db");{
                      $id = $_SESSION['user_id'];

                      $query = "SELECT COUNT(ticket_t.ticket_id)  AS count FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id)  WHERE ticket_t.ticket_category='In Progress' AND ticket_t.ticket_agent_id IS NOT NULL";

                      $result = mysqli_query($db,$query); ?>
                        <?php while($row = mysqli_fetch_assoc($result)){ ?>
                          <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                  <?php }} ?>
                </a></li>
                <li class="collapsible"><a href="review-resolved-tickets.php">Resolved
                  <?php
                    $db = mysqli_connect("localhost", "root", "", "eei_db");{
                      $id = $_SESSION['user_id'];

                      $query = "SELECT COUNT(ticket_t.ticket_id)  AS count FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id)  WHERE ticket_t.ticket_category='Technicals' AND ticket_t.ticket_status='Resolved'";

                      $result = mysqli_query($db,$query); ?>
                        <?php while($row = mysqli_fetch_assoc($result)){ ?>
                          <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                  <?php }} ?>
                </a></li>
                <li class="collapsible"><a href="review-closed-tickets.php">Closed
                  <?php
                    $db = mysqli_connect("localhost", "root", "", "eei_db");{
                      $id = $_SESSION['user_id'];

                      $query = "SELECT COUNT(ticket_t.ticket_id)  AS count FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id)  WHERE ticket_t.ticket_category='Technicals' AND ticket_t.ticket_status='Closed'";

                      $result = mysqli_query($db,$query); ?>
                        <?php while($row = mysqli_fetch_assoc($result)){ ?>
                          <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                  <?php }} ?>
                </a></li>
              </ul>
            </div>
          </li>
        </ul>

      <?php } elseif($_SESSION['user_type'] == 'Access Group Manager'){ ?>
        <ul class="collapsible collapsible-accordion">
          <li>
            <a class="collapsible-header tooltipped" data-position="right" data-delay="50" data-tooltip="Tickets of my team"  href="#!"><i class="tiny material-icons">vpn_key</i>Access Tickets</a>
            <div class="collapsible-body">
              <ul>
                <li class="collapsible"><a href="review-incoming-tickets.php">Incoming
                  <?php
                    $db = mysqli_connect("localhost", "root", "", "eei_db");{
                      $id = $_SESSION['user_id'];

                      $query = "SELECT COUNT(ticket_t.ticket_id)  AS count FROM ticket_t LEFT JOIN user_access_ticket_t USING (ticket_id)  LEFT JOIN ticket_status_t stat ON stat.status_id = ticket_t.ticket_status WHERE ticket_t.ticket_category='Access' AND stat.ticket_status='Pending'";

                      $result = mysqli_query($db,$query); ?>
                        <?php while($row = mysqli_fetch_assoc($result)){ ?>
                          <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                  <?php }} ?>
                </a></li>
                <li class="collapsible"><a href="review-tickets.php">All
                  <?php
                    $db = mysqli_connect("localhost", "root", "", "eei_db");{
                      $id = $_SESSION['user_id'];

                      $query = "SELECT COUNT(ticket_t.ticket_id)  AS count FROM ticket_t LEFT JOIN user_access_ticket_t USING (ticket_id) WHERE ticket_t.ticket_category='Access' AND (ticket_t.ticket_status='Resolved' OR ticket_t.ticket_status='In Progress' OR ticket_t.ticket_status='Closed')";

                      $result = mysqli_query($db,$query); ?>
                        <?php while($row = mysqli_fetch_assoc($result)){ ?>
                          <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                  <?php }} ?>
                </a></li>
                <li class="collapsible"><a href="review-inprogress-tickets.php">In Progress
                  <?php
                    $db = mysqli_connect("localhost", "root", "", "eei_db");{
                      $id = $_SESSION['user_id'];

                      $query = "SELECT COUNT(ticket_t.ticket_id)  AS count FROM ticket_t LEFT JOIN user_access_ticket_t USING (ticket_id)  LEFT JOIN ticket_status_t stat ON stat.status_id = ticket_t.ticket_status WHERE ticket_t.ticket_category='Access' AND stat.ticket_status='In Progress'";

                      $result = mysqli_query($db,$query); ?>
                        <?php while($row = mysqli_fetch_assoc($result)){ ?>
                          <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                  <?php }} ?>
                </a></li>
                <li class="collapsible"><a href="review-resolved-tickets.php">Resolved
                  <?php
                    $db = mysqli_connect("localhost", "root", "", "eei_db");{
                      $id = $_SESSION['user_id'];

                      $query = "SELECT COUNT(ticket_t.ticket_id)  AS count FROM ticket_t LEFT JOIN user_access_ticket_t USING (ticket_id)  LEFT JOIN ticket_status_t stat ON stat.status_id = ticket_t.ticket_status WHERE ticket_t.ticket_category='Access' AND stat.ticket_status='Resolved'";

                      $result = mysqli_query($db,$query); ?>
                        <?php while($row = mysqli_fetch_assoc($result)){ ?>
                          <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                  <?php }} ?>
                </a></li>
                <li class="collapsible"><a href="review-closed-tickets.php">Closed
                  <?php
                    $db = mysqli_connect("localhost", "root", "", "eei_db");{
                      $id = $_SESSION['user_id'];

                      $query = "SELECT COUNT(ticket_t.ticket_id)  AS count FROM ticket_t LEFT JOIN user_access_ticket_t USING (ticket_id)  LEFT JOIN ticket_status_t stat ON stat.status_id = ticket_t.ticket_status WHERE ticket_t.ticket_category='Access' AND stat.ticket_status='Closed'";

                      $result = mysqli_query($db,$query); ?>
                        <?php while($row = mysqli_fetch_assoc($result)){ ?>
                          <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                  <?php }} ?>
                </a></li>
              </ul>
            </div>
          </li>
        </ul>
        <li><a href="manageUsers.php"><i class="tiny material-icons">settings</i>Manage Users</a></li>

      <?php } elseif($_SESSION['user_type'] == 'Network Group Manager'){ ?>
        <ul class="collapsible collapsible-accordion">
          <li>
            <a class="collapsible-header tooltipped" data-position="right" data-delay="50" data-tooltip="Tickets of my team"  href="#!"><i class="tiny material-icons">network_wifi</i>Network Tickets</a>
            <div class="collapsible-body">
              <ul>
                <li class="collapsible"><a href="review-incoming-tickets.php">Incoming
                  <?php
                    $db = mysqli_connect("localhost", "root", "", "eei_db");{
                      $id = $_SESSION['user_id'];

                      $query = "SELECT COUNT(ticket_t.ticket_id)  AS count FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id)  LEFT JOIN user_access_ticket_t USING (ticket_id) WHERE ticket_t.ticket_category='Network' AND ticket_t.ticket_status='Pending'";

                      $result = mysqli_query($db,$query); ?>
                        <?php while($row = mysqli_fetch_assoc($result)){ ?>
                          <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                  <?php }} ?>
                </a></li>
                <li class="collapsible"><a href="review-tickets.php">All
                  <?php
                    $db = mysqli_connect("localhost", "root", "", "eei_db");{
                      $id = $_SESSION['user_id'];

                      $query = "SELECT COUNT(ticket_t.ticket_id)  AS count FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id) WHERE ticket_t.ticket_category='Network'";

                      $result = mysqli_query($db,$query); ?>
                        <?php while($row = mysqli_fetch_assoc($result)){ ?>
                          <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                  <?php }} ?>
                </a></li>
                <li class="collapsible"><a href="review-inprogress-tickets.php">In Progress
                  <?php
                    $db = mysqli_connect("localhost", "root", "", "eei_db");{
                      $id = $_SESSION['user_id'];

                      $query = "SELECT COUNT(ticket_t.ticket_id)  AS count FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id) WHERE ticket_t.ticket_category='Network' AND ticket_t.ticket_status='In Progress'";

                      $result = mysqli_query($db,$query); ?>
                        <?php while($row = mysqli_fetch_assoc($result)){ ?>
                          <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                  <?php }} ?>
                </a></li>
                <li class="collapsible"><a href="review-resolved-tickets.php">Resolved
                  <?php
                    $db = mysqli_connect("localhost", "root", "", "eei_db");{
                      $id = $_SESSION['user_id'];

                      $query = "SELECT COUNT(ticket_t.ticket_id)  AS count FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id)  WHERE ticket_t.ticket_category='Network' AND ticket_t.ticket_status='Resolved'";

                      $result = mysqli_query($db,$query); ?>
                        <?php while($row = mysqli_fetch_assoc($result)){ ?>
                          <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                  <?php }} ?>
                </a></li>
                <li class="collapsible"><a href="review-closed-tickets.php">Closed
                  <?php
                    $db = mysqli_connect("localhost", "root", "", "eei_db");{
                      $id = $_SESSION['user_id'];

                      $query = "SELECT COUNT(ticket_t.ticket_id)  AS count FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id) WHERE ticket_t.ticket_category='Network' AND ticket_t.ticket_status='Closed'";

                      $result = mysqli_query($db,$query); ?>
                        <?php while($row = mysqli_fetch_assoc($result)){ ?>
                          <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                  <?php }} ?>
                </a></li>
              </ul>
            </div>
          </li>
        </ul>
      <?php } elseif($_SESSION['user_type'] == 'Technician' OR $_SESSION['user_type'] == 'Network Engineer'){ ?>
         <ul class="collapsible collapsible-accordion">
           <li>
             <a class="collapsible-header" href="#!"><i class="tiny material-icons">view_list</i>My Assigned Tickets</a>
             <div class="collapsible-body">
               <ul>
                 <li class="collapsible"><a href="review-incoming-tickets.php">Incoming
                 <!-- DISPLAY ASSIGNED TICKETS OF TECHNICIAN-->
                 <?php
                   if($_SESSION['user_type'] == 'Technician') {

                       $query = "SELECT COUNT(ticket_t.ticket_id) AS count FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) WHERE ticket_t.ticket_status='Pending' AND ticket_t.ticket_category='Technicals' AND ticket_t.ticket_agent_id = '".$_SESSION['user_id']."'";

                       $result = mysqli_query($db,$query); ?>

                       <?php while($row = mysqli_fetch_assoc($result)){ ?>
                         <span class="badge ticket_count"> <?php echo $row['count']?></span>


                       <?php }} elseif($_SESSION['user_type'] == 'Network Engineer'){

                       $query = "SELECT COUNT(ticket_t.ticket_id) AS count FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id) WHERE ticket_t.ticket_status='Pending' AND ticket_t.ticket_category='Network' AND ticket_t.ticket_agent_id = '".$_SESSION['user_id']."'";

                       $result = mysqli_query($db,$query); ?>

                       <?php while($row = mysqli_fetch_assoc($result)){ ?>
                         <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                       <?php }} ?>
                  </a></li>
                 <li class="collapsible"><a href="review-tickets.php">All
                   <?php
                     if($_SESSION['user_type'] == 'Technician') {
                   ?>
                     <?php
                         $query = "SELECT COUNT(ticket_t.ticket_id) AS count FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) WHERE ticket_t.ticket_category='Technicals' AND ticket_t.ticket_agent_id = '".$_SESSION['user_id']."'";

                         $result = mysqli_query($db,$query); ?>

                         <?php while($row = mysqli_fetch_assoc($result)){ ?>
                           <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                         <?php } } elseif($_SESSION['user_type'] == 'Network Engineer'){?>
                     <?php
                         $query = "SELECT COUNT(ticket_t.ticket_id) AS count FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id)  WHERE ticket_t.ticket_category='Network' AND ticket_t.ticket_agent_id = '".$_SESSION['user_id']."'";

                         $result = mysqli_query($db,$query); ?>

                         <?php while($row = mysqli_fetch_assoc($result)){ ?>
                           <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                         <?php }} ?>
                    </a></li>
                   <li class="collapsible"><a href="review-inprogress-tickets.php">In Progress <?php
                      if($_SESSION['user_type'] == 'Technician') {
                    ?>
                      <?php
                          $query = "SELECT COUNT(ticket_t.ticket_id) AS count FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) WHERE ticket_t.ticket_status='In Progress' AND ticket_t.ticket_category='Technicals' AND ticket_t.ticket_agent_id = '".$_SESSION['user_id']."'";

                          $result = mysqli_query($db,$query); ?>

                          <?php while($row = mysqli_fetch_assoc($result)){ ?>
                            <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                          <?php } } elseif($_SESSION['user_type'] == 'Network Engineer'){?>
                      <?php
                          $query = "SELECT COUNT(ticket_t.ticket_id) AS count FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id)  WHERE ticket_t.ticket_status='In Progress' AND ticket_t.ticket_category='Network' AND ticket_t.ticket_agent_id = '".$_SESSION['user_id']."'";

                          $result = mysqli_query($db,$query); ?>

                          <?php while($row = mysqli_fetch_assoc($result)){ ?>
                            <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                          <?php }} ?>
                     </a></li>
                     <li class="collapsible"><a href="review-resolved-tickets.php">Resolved <?php
                        if($_SESSION['user_type'] == 'Technician') {
                      ?>
                        <?php
                            $query = "SELECT COUNT(ticket_t.ticket_id) AS count FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) WHERE ticket_t.ticket_status='Pending' AND ticket_t.ticket_category='Technicals' AND ticket_t.ticket_agent_id = '".$_SESSION['user_id']."'";

                            $result = mysqli_query($db,$query); ?>

                            <?php while($row = mysqli_fetch_assoc($result)){ ?>
                              <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                            <?php } } elseif($_SESSION['user_type'] == 'Network Engineer'){?>
                        <?php
                            $query = "SELECT COUNT(ticket_t.ticket_id) AS count FROM ticket_t LEFT JOIN user_access_ticket_t USING (ticket_id) LEFT JOIN service_ticket_t USING (ticket_id)  WHERE ticket_t.ticket_status='Resolved' AND ticket_t.ticket_category='Network' AND ticket_t.ticket_agent_id = '".$_SESSION['user_id']."'";

                            $result = mysqli_query($db,$query); ?>

                            <?php while($row = mysqli_fetch_assoc($result)){ ?>
                              <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                            <?php }} ?>
                       </a></li>
                     <li class="collapsible"><a href="review-closed-tickets.php">Closed <?php
                        if($_SESSION['user_type'] == 'Technician') {
                      ?>
                        <?php
                            $query = "SELECT COUNT(ticket_t.ticket_id) AS count FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) WHERE ticket_t.ticket_status='Closed' AND ticket_t.ticket_category='Technicals' AND ticket_t.ticket_agent_id = '".$_SESSION['user_id']."'";

                            $result = mysqli_query($db,$query); ?>

                            <?php while($row = mysqli_fetch_assoc($result)){ ?>
                              <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                            <?php } } elseif($_SESSION['user_type'] == 'Network Engineer'){?>
                        <?php
                            $query = "SELECT COUNT(ticket_t.ticket_id) AS count FROM ticket_t LEFT JOIN user_access_ticket_t USING (ticket_id) LEFT JOIN service_ticket_t USING (ticket_id) WHERE ticket_t.ticket_status='Closed' AND ticket_t.ticket_category='Network' AND ticket_t.ticket_agent_id = '".$_SESSION['user_id']."'";

                            $result = mysqli_query($db,$query); ?>

                            <?php while($row = mysqli_fetch_assoc($result)){ ?>
                              <span class="badge ticket_count"> <?php echo $row['count'] ?></span>
                            <?php }} ?>
                       </a></li>
               </ul>
             </div>
           </li>
         </ul>
      <?php } ?>

    </ul>
    <!-- End of slideout navigation  -->

  <!-- Hamburger menu icon when screen resized -->
  <a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
</div>
<!-- End of Side Navigation -->
