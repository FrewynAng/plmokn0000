<!--
********************
** Leave_Dlt.php **
********************
-->

<?php session_start(); ?>

<html>

<head>
  <link rel="stylesheet" type="text/css" href="../css/form.css">
  <meta charset="UTF-8">
  <title>GalaxyTime</title>
</head>

<body>

  <?php
  include '../Main/navBar.php';

  $StaffID = $_GET["StaffID"];
  $LeaveTyp = $_GET["LeaveTyp"];
  $DateFR = date("Y-m-d", strtotime($_GET["DateFR"]));
  $DateTO = date("Y-m-d", strtotime($_GET["DateTO"]));
  $NoOfDay = $_GET["NoOfDay"];

  $sql =
  "DELETE FROM `LeaveTable`
  WHERE
  `StaffID` = '$StaffID' AND `LeaveTyp` = '$LeaveTyp' AND `DateFR` = '$DateFR' AND `DateTO` = '$DateTO' AND `NoOfDay` = '$NoOfDay'";

  if ($conn->query($sql) === TRUE)
  {
    $_SESSION['cmpMsg'] = "Record Deleted.";
    $url = "Location:../Leave/LeaveTable.php?menu={$menu}";
    header($url);
  }
  else
  {
    $_SESSION['rjtMsg'] =  "Error: " . $sql . $conn->error;
  }

  $conn->close();
  ?>

</body>
</html>
