EEI'S SLA
SEV 1 - 4 hours - Critical
SEV 2 - 6 hours - Important
SEV 3 - 8 hours - Normal
SEV 4 - 1 day - Low
SEV 5 - 2 days - Very Low

<?php
session_start();
$db = mysqli_connect("localhost", "root", "", "eei_db");

$startdate - timestamp when ticket was assigned a severity level
$duedate - sevtime based on their SLAs
$resolutiondate - timestamp when ticket_status was changed to 'Resolved'
$overdueby -
$timetaken - current number of hours/minutes/days the ticket

if (severity_level == 'SEV1'){
  $sevtime = 4 hours;
} elseif (severity_level == 'SEV2'){
  $sevtime = 6 hours;
} elseif (severity_level == 'SEV3'){
  $sevtime = 8 hours;
} elseif (severity_level == 'SEV4') {
  $sevtime = 24 hours; //clarify if business hours or not
} elseif (severity_level == 'SEV5') {
  $sevtime = 48 hours;
}


//get the severity level of the ticket
//startdate = get the date_prepared timestamp when ticket was assigned a severity severity_level
//duedate = startdate + sevtime
//timetaken = curdatetime - startdate
//overdueby = timetaken - duedate
