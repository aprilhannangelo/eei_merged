<!-- <div class="container" id="dashboard"> -->
<input class="waves-effect waves-light submit" id="request-form" name="submit" type="submit" value="Export">

<div class="table-header">
  <span class="table-title"><b>Ticket Summary</b></span>
</div>
<div class="row">
  <ul class="tabs">
   <li class="tab col s4 l4"><a href="#test-swipe-1">Status</a></li>
   <li class="tab col s4 l4"><a href="#test-swipe-2">Category</a></li>
   <li class="tab col s4 l4"><a href="#test-swipe-3">Severity</a></li>

  </ul>
</div>
   <div id="test-swipe-1" class="col s12">
     <!-- <div class="col s12 m12 l12"> -->
       <div class="row">
         <div class="col s12 m4 l2" id="db-panel">
           <div class="card-panel grey lighten-5">
             <span id="db-panel-label-overdue">Overdue</span>
             <!-- get number of tickets whose due date base on their severity level has passed -->
             <!-- placeholder lang yung result nito for now hehe -->
             <?php
             $db = mysqli_connect("localhost", "root", "", "eei_db");

               $query = "SELECT COUNT(*) AS status FROM ticket_t LEFT JOIN sla_t sev ON sev.id=ticket_t.severity_level LEFT JOIN ticket_status_t stat ON stat.status_id = ticket_t.ticket_status WHERE stat.ticket_status='In Progress'";
               $result = mysqli_query($db,$query);

               while($row = mysqli_fetch_assoc($result)){
                  echo "<h3 class=\"db-panel-label-overdue\">" . $row['status'] . "</h3>";
              };
             ?>
           </div>
         </div>
         <div class="col s6 m2 l2" id="db-panel">
           <div class="card-panel grey lighten-5">
             <span class="black-text" id="db-panel-label">In Progress</span>
             <?php
             $db = mysqli_connect("localhost", "root", "", "eei_db");

               $query = "SELECT COUNT(*) AS status FROM ticket_t LEFT JOIN sla_t sev ON sev.id=ticket_t.severity_level LEFT JOIN ticket_status_t stat ON stat.status_id = ticket_t.ticket_status WHERE stat.ticket_status='In Progress'";
               $result = mysqli_query($db,$query);

               while($row = mysqli_fetch_assoc($result)){
                  echo "<h3>" . $row['status'] . "</h3>";
              };
             ?>
           </div>
         </div>
         <div class="col s6 m2 l2" id="db-panel">
           <div class="card-panel grey lighten-5">
             <span class="black-text" id="db-panel-label">Pending</span>
             <?php
             $db = mysqli_connect("localhost", "root", "", "eei_db");

               $query = "SELECT COUNT(*) AS status FROM ticket_t LEFT JOIN sla_t sev ON sev.id=ticket_t.severity_level LEFT JOIN ticket_status_t stat ON stat.status_id = ticket_t.ticket_status WHERE stat.ticket_status='Pending'";
               $result = mysqli_query($db,$query);

               while($row = mysqli_fetch_assoc($result)){
                 echo "<h3>" . $row['status'] . "</h3>";
              };
             ?>
           </div>
         </div>
         <div class="col s6 m2 l2" id="db-panel">
           <div class="card-panel grey lighten-5">
             <span class="black-text" id="db-panel-label">Resolved</span>
             <?php
             $db = mysqli_connect("localhost", "root", "", "eei_db");

               $query = "SELECT COUNT(*) AS status FROM ticket_t LEFT JOIN sla_t sev ON sev.id=ticket_t.severity_level LEFT JOIN ticket_status_t stat ON stat.status_id = ticket_t.ticket_status WHERE stat.ticket_status='Resolved'";
               $result = mysqli_query($db,$query);

               while($row = mysqli_fetch_assoc($result)){
                 echo "<h3>" . $row['status'] . "</h3>";
              };
             ?>
           </div>
         </div>
         <div class="col s6 m4 l2" id="db-panel">
           <div class="card-panel grey lighten-5">
             <span class="black-text" id="db-panel-label">Closed</span>
             <?php
             $db = mysqli_connect("localhost", "root", "", "eei_db");

               $query = "SELECT COUNT(*) AS status FROM ticket_t LEFT JOIN sla_t sev ON sev.id=ticket_t.severity_level LEFT JOIN ticket_status_t stat ON stat.status_id = ticket_t.ticket_status WHERE stat.ticket_status='Closed'";
               $result = mysqli_query($db,$query);

               while($row = mysqli_fetch_assoc($result)){
                 echo "<h3>" . $row['status'] . "</h3>";
              };
             ?>
           </div>
         </div>
         <div class="col s6 m4 l2" id="db-panel">
           <div class="card-panel grey lighten-5">
             <span class="black-text" id="db-panel-label">Cancelled</span>
             <?php
             $db = mysqli_connect("localhost", "root", "", "eei_db");

               $query = "SELECT COUNT(*) AS status FROM ticket_t LEFT JOIN sla_t sev ON sev.id=ticket_t.severity_level LEFT JOIN ticket_status_t stat ON stat.status_id = ticket_t.ticket_status WHERE stat.ticket_status='Cancelled'";
               $result = mysqli_query($db,$query);

               while($row = mysqli_fetch_assoc($result)){
                 echo "<h3>" . $row['status'] . "</h3>";
              };
             ?>
           </div>
         </div>
       </div>
     <!-- </div> -->
   </div>

<div id="test-swipe-2" class="col s12">
 <div class="col s12 m12 l12">
   <div class="row">
     <div class="col s12 m4 l4">
       <div class="card-panel grey lighten-5" id="db-panel-2">
         <span class="black-text" id="db-panel-label">Technicals</span>
         <!-- get number of tickets whose due date base on their severity level has passed -->
         <?php
         $db = mysqli_connect("localhost", "root", "", "eei_db");

           $query = "SELECT COUNT(ticket_category) AS cat FROM ticket_t WHERE ticket_category='Technicals'";
           $result = mysqli_query($db,$query);

           while($row = mysqli_fetch_assoc($result)){
              echo "<h3>" . $row['cat'] . "</h3>";
          };
         ?>
       </div>
     </div>
     <div class="col s12 m4 l4">
       <div class="card-panel grey lighten-5" id="db-panel-2">
         <span class="black-text" id="db-panel-label">Access</span>
         <?php
         $db = mysqli_connect("localhost", "root", "", "eei_db");

         $query = "SELECT COUNT(ticket_category) AS cat FROM ticket_t WHERE ticket_category='Access'";
           $result = mysqli_query($db,$query);

           while($row = mysqli_fetch_assoc($result)){
              echo "<h3>" . $row['cat'] . "</h3>";
          };
         ?>
       </div>
     </div>
     <div class="col s12 m4 l4">
       <div class="card-panel grey lighten-5" id="db-panel-2">
         <span class="black-text" id="db-panel-label">Network</span>
         <?php
         $db = mysqli_connect("localhost", "root", "", "eei_db");

           $query = "SELECT COUNT(ticket_category) AS cat FROM ticket_t WHERE ticket_category='Network'";
           $result = mysqli_query($db,$query);

           while($row = mysqli_fetch_assoc($result)){
             echo "<h3>" . $row['cat'] . "</h3>";
          };
         ?>
       </div>
     </div>
     </div>
   </div>
 </div>
 <div id="test-swipe-3" class="col s12">
   <div class="col s12 m12 l12">
     <div class="row">
       <div class="col s6 m6 l3" id="db-panel">
         <div class="card-panel grey lighten-5">
           <span class="black-text" id="db-panel-label">SEV1</span>
           <?php
           $db = mysqli_connect("localhost", "root", "", "eei_db");

             $query = "SELECT COUNT(*) AS sevlvl FROM ticket_t LEFT JOIN sla_t sev ON sev.id = ticket_t.severity_level WHERE sev.severity_level='SEV1'";
             $result = mysqli_query($db,$query);

             while($row = mysqli_fetch_assoc($result)){
                echo "<h3>" . $row['sevlvl'] . "</h3>";
            };
           ?>
         </div>
       </div>
       <div class="col s6 m6 l4" id="db-panel">
         <div class="card-panel grey lighten-5">
           <span class="black-text" id="db-panel-label">SEV2</span>
           <?php
           $db = mysqli_connect("localhost", "root", "", "eei_db");

           $query = "SELECT COUNT(*) AS sevlvl FROM ticket_t LEFT JOIN sla_t sev ON sev.id = ticket_t.severity_level WHERE sev.severity_level='SEV2'";
           $result = mysqli_query($db,$query);

           while($row = mysqli_fetch_assoc($result)){
              echo "<h3>" . $row['sevlvl'] . "</h3>";
            };
           ?>
         </div>
       </div>
       <div class="col s6 m6 l4" id="db-panel">
         <div class="card-panel grey lighten-5">
           <span class="black-text" id="db-panel-label">SEV3</span>
           <?php
           $db = mysqli_connect("localhost", "root", "", "eei_db");

           $query = "SELECT COUNT(*) AS sevlvl FROM ticket_t LEFT JOIN sla_t sev ON sev.id = ticket_t.severity_level WHERE sev.severity_level='SEV3'";
           $result = mysqli_query($db,$query);

           while($row = mysqli_fetch_assoc($result)){
              echo "<h3>" . $row['sevlvl'] . "</h3>";
            };
           ?>
         </div>
       </div>
       <div class="col s6 m6 l6" id="db-panel">
         <div class="card-panel grey lighten-5">
           <span class="black-text" id="db-panel-label">SEV4</span>
           <?php
           $db = mysqli_connect("localhost", "root", "", "eei_db");

           $query = "SELECT COUNT(*) AS sevlvl FROM ticket_t LEFT JOIN sla_t sev ON sev.id = ticket_t.severity_level WHERE sev.severity_level='SEV4'";
           $result = mysqli_query($db,$query);

           while($row = mysqli_fetch_assoc($result)){
              echo "<h3>" . $row['sevlvl'] . "</h3>";
            };
           ?>
         </div>
       </div>
       <div class="col s6 m6 l6" id="db-panel">
         <div class="card-panel grey lighten-5">
           <span class="black-text" id="db-panel-label">SEV5</span>
           <?php
           $db = mysqli_connect("localhost", "root", "", "eei_db");

           $query = "SELECT COUNT(*) AS sevlvl FROM ticket_t LEFT JOIN sla_t sev ON sev.id = ticket_t.severity_level WHERE sev.severity_level='SEV5'";
           $result = mysqli_query($db,$query);

           while($row = mysqli_fetch_assoc($result)){
              echo "<h3>" . $row['sevlvl'] . "</h3>";
            };
           ?>
         </div>
       </div>
     </div>
   </div>
 </div>
 <br>
 <div class="search-bar"><h5 class="body-header"><b>Knowledge Base</b></h5>
   <!-- <div class="input-field col s12 m12 l10">
       <form>
         <input id="search" placeholder="Search knowledge base" type="search" required>
         <label class="label-icon" for="search"><i class="material-icons">search</i></label>
         <i class="material-icons">close</i>
     </form>
   </div> -->
 </div>
   <!-- <p><i>Need help on something? Try to search on our knowledge base first for simple solutions to your problems before submitting a ticket. </i></p> -->
   <!-- <ul class="collapsible collapsible-accordion">
     <li class="faq">
       <a class="collapsible-header" href="#!">Technicals <i class="right tiny material-icons">keyboard_arrow_down</i></a>
       <div class="collapsible-body">
         <ul>
           <li class="faq-category"><a href="#!">Computer</a></li>
           <li class="faq-category"><a href="#!">Printer</a></li>
           <li class="faq-category"><a href="#!">Scanner</a></li>
           <li class="faq-category"><a href="#!">Mouse</a></li>
           <li class="faq-category"><a href="#!">laptop</a></li>
         </ul>
       </div>
     </li>
     <li class="faq">
       <a class="collapsible-header" href="#!">Access <i class="right tiny material-icons">keyboard_arrow_down</i></a>
       <div class="collapsible-body">
         <ul>
           <li class="faq-category"><a href="#!">Computer</a></li>
           <li class="faq-category"><a href="#!">Printer</a></li>
           <li class="faq-category"><a href="#!">Scanner</a></li>
         </ul>
       </div>
     </li>
     <li class="faq">
       <a class="collapsible-header" href="#!">Network <i class="right tiny material-icons">keyboard_arrow_down</i></a>
       <div class="collapsible-body">
         <ul>
           <li class="faq-category"><a href="#!">Computer</a></li>
           <li class="faq-category"><a href="#!">Printer</a></li>
           <li class="faq-category"><a href="#!">Scanner</a></li>
         </ul>
       </div>
     </li>
   </ul> -->
   <div class="row">
       <div class="col s12 m4 l4">
         <div class="card">
           <div class="card-image">
             <i class="large material-icons">storage</i>
           </div>
           <div class="card-content">
             <span class="card-title">Technicals</span>

             <p>Hardware equipment, Mouse, Keyboard, Monitor, Printers, Scanners</p>
           </div>
           <div class="card-action">
             <a href="#">View Technicals FAQs</a>
           </div>
         </div>
       </div>
       <div class="col s12 m4 l4">
         <div class="card">
           <div class="card-image">
             <i class="large material-icons">vpn_lock</i>
           </div>
           <div class="card-content">
             <span class="card-title">Access</span>

             <p>Hardware access, application access, password change</p>
           </div>
           <div class="card-action">
             <a href="#">View Access FAQs</a>
           </div>
         </div>
       </div>
       <div class="col s12 m4 l4">
         <div class="card">
           <div class="card-image">
             <i class="large material-icons">network_check</i>
           </div>
           <div class="card-content">
             <span class="card-title">Network</span>
             <p>Network/Internet Access, Network Equipment (Routers, cables)</p>

           </div>
           <div class="card-action">
             <a href="#">View Network FAQs</a>
           </div>
         </div>
       </div>
     </div>
 <!-- </div> -->
