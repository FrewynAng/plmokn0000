<!--
*****************
** Welcome.php **
*****************
-->

<?php session_start(); ?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" type="text/css" href="../css/Style.css">
  <meta charset="UTF-8">
  <meta http-equiv="Refresh" content="20">
  <title>Welcome Menu</title>
</head>

<body class="hdr_Bdy">

  <?php
  include '../Main/getSysPar.php';

  echo date("l") . ", " . date("d-m-Y *h:i a") . "<br>";

  //echo  "Today is " . date("l") . ", " . date("d-m-Y   *h:i:sA(P)");

  $conn->close();
  ?>

</body>
</html>
