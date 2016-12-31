<!--
*********************
** UserGrp_Dlt.php **
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
    $UsrGrp = $_GET["UsrGrp"];
    $UsrAccSeq = $_GET["UsrAccSeq"];

    $sql =
    "DELETE FROM `UsrGrpPar`
     WHERE
     `UsrGrp` = '$UsrGrp' AND `UsrAccSeq` = '$UsrAccSeq'";

    if ($conn->query($sql) === TRUE)
    {
      $_SESSION['cmpMsg'] = "Record Deleted.";
      $url = "Location:../Admin/UserGrp.php?menu={$menu}";
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
