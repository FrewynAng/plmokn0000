<!--
***********************
** ShfGrp_Dlt.php **
***********************
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
  $cmpMsg = $_SESSION['cmpMsg'];

  $ShfNo = $_GET["ShfNo"];
  $StaffID = $_GET["StaffID"];

  $sql =
  "DELETE FROM `StfShfGrp`
  WHERE `ShfNo` = '$ShfNo' AND `StaffID` = '$StaffID'";

  if ($conn->query($sql) === TRUE)
  {
    $_SESSION['cmpMsg'] = "Record Deleted.";
    $url = "Location:../TimeSheet/ShfGrp.php?menu={$menu}";
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
