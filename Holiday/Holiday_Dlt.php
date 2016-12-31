<!--
*********************
** Holiday_Dlt.php **
*********************
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

  $HDate = date("Y-m-d", strtotime($_GET["HDate"]));
  //echo $HDate;

  $sql =
  "DELETE FROM `HolidayTable`
  WHERE
  `HDate` = '$HDate'";

  if ($conn->query($sql) === TRUE)
  {
    $_SESSION['cmpMsg'] = "Record Deleted.";
    $url = "Location:../Holiday/HolidayTable.php?menu={$menu}";
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
