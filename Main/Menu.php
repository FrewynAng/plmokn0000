<!--
**************
** Menu.php **
**************
-->

<?php session_start(); ?>

<!doctype html>
<html lang="en">

<head>
  <link rel="stylesheet" type="text/css" href="../css/Style.css">
  <meta charset="UTF-8">
  <title>Menu Tree</title>
</head>

<body class="mnu_body">

  <?php
  include '../Main/getSysPar.php';
  //print_r($_SESSION);

  $sql =
  "SELECT *
  FROM `UsrGrpPar`
  WHERE UsrGrp = '{$_SESSION['UsrGrp']}'
  ORDER BY UsrGrp, UsrAccSeq";
  //execute the SQL query and return records
  $result = $conn->query($sql);

  echo "<table class='mnu'><tbody>";
  while($row = $result->fetch_assoc())
  {
    // $url ="<a href='" . $row['UsrAccLink'] . "' target='cdMain'>" . $row['UsrAccDsc'] . "</a><br>";
    $url ="<tr><td class='mnu_td' onclick='dltData()' style='cursor: pointer;'>
    <a  class='mnu_lnk' href='" . $row['UsrAccLink'] . "' target='cdMain'>" . $row['UsrAccDsc'] . "</a></td></tr>";
    echo $url;
  }
  echo "</tbody></table>";

  $conn->close();
  exit();

  ?>

</body>
</html>
