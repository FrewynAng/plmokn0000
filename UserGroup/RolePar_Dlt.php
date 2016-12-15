<!--
*********************
** RolePar_Dlt.php **
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
    $RoleNo = $_GET["RoleNo"];
    $RoleDesc = $_GET["RoleDesc"];
    //echo $UsrAccSeq;

    $sql =
    "DELETE FROM `RolePar`
     WHERE
     `RoleNo` = '$RoleNo' AND `RoleDesc` = '$RoleDesc'";

    if ($conn->query($sql) === TRUE)
    {
      $_SESSION['cmpMsg'] = "Record Deleted.";
      header('Location:../UserGroup/RolePar.php');
    }
    else
    {
      $_SESSION['rjtMsg'] =  "Error: " . $sql . $conn->error;
    }

    $conn->close();
?>

</body>
</html>
