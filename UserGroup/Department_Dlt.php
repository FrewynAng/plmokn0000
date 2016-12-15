<!--
************************
** Department_Dlt.php **
************************
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
    $dpt_No = $_GET["dpt_No"];
    $dpt_desc = $_GET["dpt_desc"];
    //echo $UsrAccSeq;

    $sql =
    "DELETE FROM `Department`
     WHERE
     `dpt_No` = '$dpt_No' AND `dpt_desc` = '$dpt_desc'";

    if ($conn->query($sql) === TRUE)
    {
      $_SESSION['cmpMsg'] = "Record Deleted.";
      header('Location:../UserGroup/Department.php');
    }
    else
    {
      $_SESSION['rjtMsg'] =  "Error: " . $sql . $conn->error;
    }

    $conn->close();
?>

</body>
</html>
