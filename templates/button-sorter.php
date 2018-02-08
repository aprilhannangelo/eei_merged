<?php
$db = mysqli_connect("localhost", "root", "", "eei_db");{

//All my inprogress tickets
$query = "SELECT * FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id) WHERE ticket_t.ticket_status = 'In Progress' AND ticket_t.user_id = '".$_SESSION['user_id']."'";

//if category button for sorting is selected
  switch ((isset($_GET['view']) ? $_GET['view'] : ''))
  {
      case ("technicals"):
        $query = "SELECT * FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id) WHERE ticket_t.ticket_status = 'In Progress' AND ticket_t.ticket_category='Technicals' AND ticket_t.user_id = '".$_SESSION['user_id']."'";
        break;

      case ("access"):
        $query = "SELECT * FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id) WHERE ticket_t.ticket_status = 'In Progress' AND ticket_t.ticket_category='Access' AND ticket_t.user_id = '".$_SESSION['user_id']."'";
        break;

      case ("network"):
        $query = "SELECT * FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id) WHERE ticket_t.ticket_status = 'In Progress' AND ticket_t.ticket_category='Network' AND ticket_t.user_id = '".$_SESSION['user_id']."'";
        break;
  }

//if severity button for sorting is selected
  switch ((isset($_GET['view']) ? $_GET['view'] : ''))
  {
      case ("sev1"):
        $query = "SELECT * FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id) WHERE ticket_t.ticket_status = 'In Progress' AND ticket_t.severity_level='SEV1' AND ticket_t.user_id = '".$_SESSION['user_id']."'";
        break;

      case ("sev2"):
        $query = "SELECT * FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id) WHERE ticket_t.ticket_status = 'In Progress' AND ticket_t.severity_level='SEV2' AND ticket_t.user_id = '".$_SESSION['user_id']."'";
        break;

      case ("sev3"):
        $query = "SELECT * FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id) WHERE ticket_t.ticket_status = 'In Progress' AND ticket_t.severity_level='SEV3' AND ticket_t.user_id = '".$_SESSION['user_id']."'";
        break;

      case ("sev4"):
        $query = "SELECT * FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id) WHERE ticket_t.ticket_status = 'In Progress' AND ticket_t.severity_level='SEV4' AND ticket_t.user_id = '".$_SESSION['user_id']."'";
        break;

      case ("sev5"):
        $query = "SELECT * FROM ticket_t LEFT JOIN service_ticket_t USING (ticket_id) LEFT JOIN user_access_ticket_t USING (ticket_id) WHERE ticket_t.ticket_status = 'In Progress' AND ticket_t.severity_level='SEV5' AND ticket_t.user_id = '".$_SESSION['user_id']."'";
        break;
  }}; ?>
