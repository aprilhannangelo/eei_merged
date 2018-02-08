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

        <h4><b>Settings</b></h4>
        <div class="row">
          <ul class="tabs">
           <li class="tab col s4 l4"><a href="#test-swipe-1">SLA</a></li>
           <li class="tab col s4 l4"><a href="#test-swipe-2">Category</a></li>
           <li class="tab col s4 l4"><a href="#test-swipe-3">Ticket Status</a></li>

          </ul>
        </div>
           <div id="test-swipe-1" class="col s12">
             <div class="swipe-body">
               <div class="row">
                 <a class="waves-effect waves-light modal-trigger" id="sla" href="#modal1">Save</a>

                 <!-- Modal Trigger -->
                 <a class="waves-effect waves-light modal-trigger" id="sla" href="#modal1">Add SLA</a>
                 <br><br>

               </div>
               <div class="row">

               <div class="col s12 m12 l10">
                 <table class="striped">
                   <tr>
                     <th>Severity Level</th>
                     <th>Priority Level</th>
                     <th>Resolution Time</th>
                     <th></th>
                   </tr>
                     <?php
                     $db = mysqli_connect("localhost", "root", "", "eei_db");

                     $sevlvl = "SELECT * FROM severity_levels_t";
                     $result = mysqli_query($db,$sevlvl);
                     while ($row = mysqli_fetch_assoc($result)) {?>
                       <!-- <div class="row">
                         <form class="col s12">
                           <div class="row">
                             <div class="input-field col s10"> -->

                                  <tr>
                                    <td contenteditable="false"> <?php echo $row['severity_level']?></td>
                                    <td contenteditable="false"> <?php echo $row['description']?> </td>
                                    <td contenteditable="false"> <?php echo $row['resolution_time']?> hours </td>
                                    <td>

                                    </td>
                                  </tr>
                             </div>
                           </div>
                         </form>
                       </div>

                     <?php };?>
               </div>

               <!-- Modal Structure -->
               <div id="modal1" class="modal">
                 <div class="modal-content">
                   <h6>Edit SLA</h6><br><br>
                   <form id="add-sla" name="add-sla" method="post" action="php_processes/add-sev.php">
                     <div class="wrapper">
                       <div class="row">
                         <div class="input-field col s12 m12 l12">
                           <input placeholder="" id="sevlvl" name="sevlvl" type="text" class="validate">
                           <label for="sevlvl">Severity Level</label>
                         </div>
                       </div>
                       <br>
                       <div class="row">
                         <div class="input-field col s12 m12 l12">
                           <input placeholder="" id="desc" name="desc" type="text" class="validate">
                           <label for="desc">Level of Priority</label>
                         </div>
                       </div>
                       <br>
                       <div class="row">
                         <div class="input-field col s12 m12 l12">
                           <input placeholder="" id="sevtime" type="text" class="validate">
                           <label for="sevtime">Resolution Time</label>
                         </div>
                       </div>
                     </div>
                   <div class="modal-footer">
                     <input class="modal-action modal-close btn-flat" id="request-form-row" name="submit" type="submit" value="Save">
                   </div>
                 </form>
                 </div>
               </div>
             </div>
           </div>



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
