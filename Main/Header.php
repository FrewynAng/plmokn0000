<!--
*****************
** Welcome.php **
*****************
-->

<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="../css/header.css">
  <meta charset="UTF-8">
  <meta http-equiv="Refresh" content="1000000000000">
  <title>Welcome Menu</title>
</head>

<body class="hdr_Bdy">

  <?php
  include '../Main/getSysPar.php';
  echo "<div>";
  // echo "<div class='div_header'>" . date("l") . ", " . date("d-m-Y *h:i a") . "</div>";
  echo "<div class='div_header'>Welcome to GalaxyTime</div>";
  echo "</div>";

  //echo  "Today is " . date("l") . ", " . date("d-m-Y   *h:i:sA(P)");

  $conn->close();
  ?>

</body>
</html>
