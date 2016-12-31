<!--
*****************
** MenuHdr.php **
*****************
-->

<?php session_start(); ?>

<html>

<head>
  <link rel="stylesheet" type="text/css" href="../css/Style.css">
  <meta charset="UTF-8">
  <title>GalaxyTime</title>
</head>

<body class="mnu_body">

  <?php
  include '../Main/getSysPar.php';
  echo $Host_IP . "<br>";

  $conn->close();
  ?>

</body>
</html>
