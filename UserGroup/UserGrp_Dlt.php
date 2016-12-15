<!--
*********************
** UserGrp_Dlt.php **
*********************
-->

<?php session_start(); ?>

<html>

<head>
    <link rel="stylesheet" type="text/css" href="../css/Style.css">
    <meta charset="UTF-8">
    <title>Delete Holiday</title>
</head>

<body>

    <?php
    include '../Main/getSysPar.php';
    $UsrGrp = $_GET["UsrGrp"];
    $UsrAccSeq = $_GET["UsrAccSeq"];
    //echo $UsrAccSeq;

    $sql =
    "DELETE FROM `UsrGrpPar`
     WHERE
     `UsrGrp` = '$UsrGrp' AND `UsrAccSeq` = '$UsrAccSeq'";

    if ($conn->query($sql) === TRUE)
    {
      $_SESSION['cmpMsg'] = "Record Deleted.";
      header('Location:../UserGroup/UserGrp.php');
    }
    else
    {
      $_SESSION['rjtMsg'] =  "Error: " . $sql . $conn->error;
    }

    $conn->close();
?>

</body>
</html>
